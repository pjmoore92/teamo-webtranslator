#!/usr/bin/perl -w

# Bethel Translation Email Worker
#

#### user conf

my $user = 'upload@claddach-kirkibost.org';
my $pass = 'uploading';
my $attachdir = '/home/claddach/bethel/files/from-email';

my $mimetypes = map { qr{$_} } (
        'application/msword', # DOC
        'application/pdf',
        'application/rtf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', # DOCX 
        'text/plain', # MUST be saved .txt, else application/octet-stream
);

#### END user conf ############################################################

use strict;
use Mail::POP3Client;
use MIME::Parser;
use IO::Socket::SSL;
use POSIX qw(strftime);

sub checkdirs() {
        if (! -e $attachdir || ! -d $attachdir ) {
                &log("ERROR: $attachdir does not exist or is not a directory");
                die;
        } else {
                stat($attachdir);
                if (! -w _) {
                        &log("ERROR: $attachdir is not writable");
                        die;
                }
        }
}

sub log() {
        my $now_string = strftime "%b %m %H:%M:%S : ", localtime;
        print $now_string.$_[0]."\n";
}

## Begin script

checkdirs();

my $socket = IO::Socket::SSL->new( PeerAddr => 'pop.gmail.com',
        PeerPort => 995,
        Proto    => 'tcp') || die "No socket!";
my $pop = Mail::POP3Client->new();
$pop->User($user);
$pop->Pass($pass);
$pop->Socket($socket);
$pop->Connect() >= 0 || die $pop->Message();

my $num = $pop->Count();
if ($num > 0) {
        &log("------------------------------- BEGIN -------------------------------");
        &log("Found $num new message(s)");
        for( my $i = 1; $i <= $pop->Count(); $i++ ) {
                my $parser = new MIME::Parser;
                $parser->output_under("/tmp"); 

                my $io = new IO::File;
                my $file = "/tmp/raw-message.$i";
                if ($io->open("> $file")) {
                        $pop->HeadAndBodyToFile( $io, $i );
                        $io->close;
                        $pop->Delete( $i );
                        my $message = $parser->parse_open( $file );

                        ## First check if this is a reply to a note
                        ## note subjects contain magic word NTE<jobid>
                        my $head = $message->head;
                        if (my $notenum = ($head->get('Subject') =~ /NTE<[0..9]+>/)) {
                                &log("processing note $notenum");
                        }
                        my $from = $message->head()->get('From');
                        chomp($from);
                        #TODO do db check for existing activated customer

                        # check attachments
                        foreach my $part ($message->parts()) {
                                my $head = $part->head;
                                my $type = $head->mime_type;
                                my $filename = $head->recommended_filename;
                                &log("$from: $head $type $filename");
                        }
                        unlink($file); ## delete raw message
                        $parser->filer->purge; ## delete tmp files
                }
        }
}
else {
        &log("- Tick --------------------------------------------------------------");
}

$pop->Close();

#EOF
