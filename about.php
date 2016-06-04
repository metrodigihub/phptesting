#----------------------------------------------------------------------------
# Module   : General Validation module for perl
# Author   : Deepankumar P | Associate Programmer
# Function : CTAE
#----------------------------------------------------------------------------

my $Ver = "1.0";

=head1 NAME

iPerl::GeneralValidation - Perl General Validation Module


=head2 iPerl::GeneralValidation Version

	1.0

=head1 Histroy

	v1.0 | 29082015 | Deepankumar P | Initial Develoment

=head1 DEPENDENCIES

=head2 Perl Version

	5.006

=head2 Modules Used

	use strict;
	use warnings;
	use Win32;
	use File::Basename;
	use File::Find;
	use PerlIO::encoding;
	use utf8;
	use Archive::Zip qw(AZ_OK COMPRESSION_STORED);
	use Roman;

=head2 Dll and OCX

	comctl32.dll

=head1 FUNCTIONS & METHODS

=cut

package iPerl::GeneralValidation;

# Module declaration
use strict;
use 5.006;
use warnings;
use Win32;
	BEGIN { Win32::LoadLibrary("comctl32.dll") }
use File::Basename;
use File::Find;
use File::Copy;
use Archive::Zip qw(AZ_OK COMPRESSION_STORED);
use Roman;
use RWFile::ReadWrite;
#use utf8;

# localize methods
our(@ISA, @EXPORT, $VERSION);
require Exporter;
@ISA = qw(Exporter);
@EXPORT = qw(	
			_General_Validation
			);
			
#=====================================================

=head3 _General_Validation

	This is the method used to "General Validation" in xml without customer basis.

	Function Name: _General_Validation(<filepath>)
	Arguments    : Arg1 => File name with path
	Return       : File All content in scalar
	Usage        : my $content = _General_Validation($path);

=cut

sub _General_Validation
{
	my $xmlstr = shift;
	my $tempstr;
	my $Error = "";
    #Checking Non ASCII characters	
	# while($xmlstr =~ /([[:^ascii:]]|\'|\`)/gs )
	# {
			# my $val = $&; my $pre = $`;
			# my $lcv=FirstLine($pre);
			# my ($ln,$col)=$lcv=~ m#^([^\t]+)\t(\d*)$#is;
			# my $l=$ln;	
			# my $c=$col+1;
			# $Error .="[$l:$c]: Error: [GV-1001]: Non-ASCII characters found '$val', Please Check the XML file.\n";
	# }
	
    #Empty Tags
    while($xmlstr =~ /<([^><]*)>\s*<\/\1>/sgi)
    {
			my $val = $&; my $pre = $`;
			my $lcv=FirstLine($pre);
			my ($ln,$col)=$lcv=~ m#^([^\t]+)\t(\d*)$#is;
			my $l=$ln;	
			my $c=$col+1;
            $Error .="[$l:$c]: Error: [GV-1002]: Empty tag '$val' is not allowed, Please Check the XML file.\n";
    }

    #Tab Checking:
    while($xmlstr =~ /[\t]+/sgi)
    {
			my $val = $&; my $pre = $`;
			my $lcv=FirstLine($pre);
			my ($ln,$col)=$lcv=~ m#^([^\t]+)\t(\d*)$#is;
			my $l=$ln;	
			my $c=$col+1;
            $Error .="[$l:$c]: Error: [GV-1003]: The usage of tab character is not allowed, Please Check the XML file.\n";
    }
   
    #space before open tag
    while($xmlstr =~ /<(?!\/|\?|\!)[^\/>]*>[ ]+/sgi)
    {
            my $val = $&; my $pre = $`;
			my $lcv=FirstLine($pre);
			my ($ln,$col)=$lcv=~ m#^([^\t]+)\t(\d*)$#is;
			my $l=$ln;	
			my $c=$col+1;
            $Error .="[$l:$c]: Error: [GV-1004]: The word space exits after the opening tag '$val', Please Check the XML file.\n";
    }

    #space before closing tag
    while($xmlstr =~ /[ ]+<\/[^>]*>/sgi)
    {
            my $val = $&; my $pre = $`;
			my $lcv=FirstLine($pre);
			my ($ln,$col)=$lcv=~ m#^([^\t]+)\t(\d*)$#is;
			my $l=$ln;	
			my $c=$col+1;
            $Error .="[$l:$c]: Error: [GV-1005]: The word space exits before the closing tag '$val', Please Check the XML file.\n";
    }
 
    #Multiple space or multiple enter marks
    while($xmlstr =~ /[ ]{2,}/gis)
    {
            my $val = $&; my $pre = $`;
			my $lcv=FirstLine($pre);
			my ($ln,$col)=$lcv=~ m#^([^\t]+)\t(\d*)$#is;
			my $l=$ln;	
			my $c=$col+1;
            $Error .="[$l:$c]: Error: [GV-1006]: Check for multiple space in the XML file.\n";
    }
	
    while($xmlstr =~ /\n{2,}/gis)
    {
            my $val = $&; my $pre = $`;
			my $lcv=FirstLine($pre);
			my ($ln,$col)=$lcv=~ m#^([^\t]+)\t(\d*)$#is;
			my $l=$ln;	
			my $c=$col+1;
            $Error .="[$l:$c]: Error: [GV-1007]: Check for multiple enter mark in the XML file.\n";
    }

    #Check empty attribute in tags:
    while($xmlstr =~ /<[^>]+=\"\"[^>]*>/gis)
    {
            my $val = $&; my $pre = $`;
			my $lcv=FirstLine($pre);
			my ($ln,$col)=$lcv=~ m#^([^\t]+)\t(\d*)$#is;
			my $l=$ln;	
			my $c=$col+1;
            $Error .="[$l:$c]: Error: [GV-1008]: Check for empty attribute in tag '$val'.\n";
    }        
    
    #comment tag checking:
    while($xmlstr =~ /<\!--(?:(?!<\!--).)*-->/gis)
    {
            my $val = $&; my $pre = $`;
			my $lcv=FirstLine($pre);
			my ($ln,$col)=$lcv=~ m#^([^\t]+)\t(\d*)$#is;
			my $l=$ln;	
			my $c=$col+1;
            $Error .="[$l:$c]: Error: [GV-1009]: Comment tag should not be used in the XML file.\n";
    }
	
	#W: Check Keyboard chr.
    while($xmlstr =~ m/([\'\~])/igs)
    {
            my $match = $&; my $pre = $`; my $val = $1; my ($ln, $cl) = LineCol($pre);
            $Error .= "\n[$ln:$cl]: Warning: [GV-1010]: '$val' Check Keyboard chr. found.";
    }
	
	#W: Space presented before dot [.], [,], [;]
    while($xmlstr =~ m/([ ](?:\.|\,|\;))/igs)
    {
            my $pre = $`; my $mtxt = $1;
            my ($ln, $cl) = LineCol($pre);
            $mtxt =~ s/\n//ig;
            $Error .= "\n[$ln:$cl]: Warning: [GV-1011]: Space presented before '$mtxt'";
    }
	
	#E: Check tab space found in the text (except preformat elements).
    #W: Check double space found in the text (except preformat elements).
    while($xmlstr =~ m/(\t{1,}|[^\s]*[ ][ ]+|\n[ ]+|[ ]+\n)/isg)
    {
            my $pre = $`; my $mtxt = $1;
            my ($ln, $cl) = LineCol($pre);
            $mtxt =~ s/\n//ig;

            if($mtxt =~ m/\t/i){
                    $Error .= "\n[$ln:$cl]: Error: [GV-1012]: '$mtxt' Unwanted Tab(s) found.";
            }
            else{$Error .= "\n[$ln:$cl]: warning: [GV-1013]: '$mtxt' Unwanted Space(s) found.";}
    }
	
	#E: Space presented before the right double quotation(&#x201D;)
    while($xmlstr =~ m/\s+(\&\#x201D\;)/igs)
    {
            my $pre = $`; my $mtxt = $1;
            my ($ln, $cl) = LineCol($pre);
            $Error .= "\n[$ln:$cl]: Error: [GV-1014]: '$mtxt' Space found before the right double quotation.";
    }
	
	#E: Space found after the left single quotation(&#x2018;)
    while($xmlstr =~ m/(\&\#x2018\;)\s+/igs)
    {
            my $pre = $`; my $mtxt = $1;
            my ($ln, $cl) = LineCol($pre);
            $Error .= "\n[$ln:$cl]: Error: [GV-1015]: '$mtxt' Space found after the left single quotation.";
    }

    #E: Space found before the right single quotation(&#x2019;)
    while($xmlstr =~ m/\s+(\&\#x2019\;)/isg)
    {
            my $pre = $`; my $mtxt = $1;
            my ($ln, $cl) = LineCol($pre);
            $Error .= "\n[$ln:$cl]: Error: [GV-1016]: '$mtxt' Space found before the right single quotation.";
    }

    #E: Space found after the left double quotation(&#x201C;)
    while($xmlstr =~ m/(\&\#x201C\;)\s+/isg)
    {
            my $pre = $`; my $mtxt = $1;
            my ($ln, $cl) = LineCol($pre);
            $Error .= "\n[$ln:$cl]: Error: [GV-1017]: '$mtxt' Space found after the left double quotation.";
    }
	
	#E: Entities should be hexa decimal format with 5 digits
	while($xmlstr =~ m/&\#x([^\;]+);/igs)
    {
		my $pre1 = $`; my $txt = $1; my $mtxt = $&;
		if($txt !~ m{^[0-9a-f]{4}$}is){
			my $pre = $`;
			$pre = $pre.$pre1;
			my ($ln, $cl) = LineCol($pre);
			$Error .= "\n[$ln:$cl]: Error: [GV-1018]: '$mtxt' Entities should be hexa decimal format with 5 digits.";
		}        
    }
	
	#E: Check cross reference missing for (Fig. 1|figure 1 & 2|Figs. 1 & 2|fig. 1-6).
	while($xmlstr =~ m/[ \(](?:fig[ures\.]*|Tables?|chapters?)(?:\.)?\s+((?:[0-9]+[0-9\.]*[a-z]?|[ivxdlmc]+|[a-z][\.0-9]*)(?:(\s*(?:,|,\s*and\s+|,\s*&amp;\s+|&ndash;|\-|\&\#x2013\;))([0-9]+[0-9\.]*[a-z]?|[ivxdlmc]+|[a-z][\.0-9]*))?) /sig)
	{
        my $pre = $`; my $mtxt = $&;
        my ($ln, $cl) = LineCol($pre);
        $mtxt = Trim($mtxt);
        $Error .= "\n[$ln:$cl]: Warning: [GV-1019]: '$mtxt' cross reference is missing.";
    }
	
	#E: Check doctype doesn’t associate with DTD.
	# if($xmlstr !~ m{<\!doctype[^><]*>}sig)
	# {
        # my $pre = $`; my $mtxt = $&;
        # my ($ln, $cl) = LineCol($pre);
        # $mtxt = Trim($mtxt);
        # $Error .= "\n[$ln:$cl]: Error: [GV-1020]: '$mtxt' Check doctype doesn’t associate with DTD.";
    # }
	
	#E: DTD name should be "****.dtd".
	while($xmlstr =~ m{<\!doctype[^><]*>}sig)
	{
        my $pre1 = $`; my $mtxt = $&;
		if($mtxt !~ m{<!doctype[^><]+ "[^"]+\.dtd"[^><]*>}is){
			my $pre = $`; my $cnt = $&;
			$pre = $pre.$pre1;
			my ($ln, $cl) = LineCol($pre);
			$mtxt = Trim($mtxt);
			$Error .= "\n[$ln:$cl]: Error: [GV-1021]: '$mtxt' DTD name should be "."\"*****\.dtd"."\"";
		}
    }
	
	#W: Check for single|double quotes should not present as a key-board character - ' "
	$tempstr = $xmlstr;
	$tempstr =~ s{<[^><]+>}{
		my $tag = $&;
			$tag =~ s{.}{a}isg;
		qq($tag)
	}isge;
	while($tempstr =~ m{[\"]+}isg)
	{
		my $pre = $`; my $mtxt = $&;
		my ($ln, $cl) = LineCol($pre);
		$mtxt = Trim($mtxt);
		$Error .= "\n[$ln:$cl]: Warning: [GV-1022]: '$mtxt' Check for single|double quotes should not present as a key-board character.";
    }
	
	#W: Check space should not come before and after "(|)|[|]|{|}".
	while($xmlstr =~ m{ (?:\(|\)|\[|\]|\{|\}) }sig)
	{
        my $pre = $`; my $mtxt = $&;
        my ($ln, $cl) = LineCol($pre);
        $mtxt = Trim($mtxt);
        $Error .= "\n[$ln:$cl]: Warning: [GV-1023]: '$mtxt' Check space should not come before and after "."\"(|)|[|]|{|}"."\".";
    }
	
	#W: Check named entities are not allowed; - &ndash;.
	while($xmlstr =~ m{&ndash;}sig)
	{
        my $pre = $`; my $mtxt = $&;
        my ($ln, $cl) = LineCol($pre);
        $mtxt = Trim($mtxt);
        $Error .= "\n[$ln:$cl]: Warning: [GV-1024]: '$mtxt' Check named entities are not allowed; - &ndash;.";
    }
	
	#W: Check  Punctuations(, :, ; - )  present in closing elements.
	while($xmlstr =~ m{(?: |\:|\;|,)+</[a-z][^>]*>}sig)
	{
        my $pre = $`; my $mtxt = $&;
        my ($ln, $cl) = LineCol($pre);
        $mtxt = Trim($mtxt);
        $Error .= "\n[$ln:$cl]: Warning: [GV-1025]: '$mtxt' Check  Punctuations(, :, ; - )  present in closing elements";
    }
	
	#E: check <, > keyboard character found should be entity.
	# $tempstr = $xmlstr;
	# $tempstr =~ s{(?:<)([^><]+)(?:>)}{del;$1del;}isg;
	# while($tempstr =~ m{[><]+}isg)
	# {
		# my $pre = $`; my $mtxt = $&;
		# my ($ln, $cl) = LineCol($pre);
		# $mtxt = Trim($mtxt);
		# $Error .= "\n[$ln:$cl]: Error: [GV-1026]: '$mtxt' check <, > keyboard character found should be entity.";
    # }
	return $Error;
}
sub FirstLine{
	my ($fpre)=@_; my $fln; my $fcol;
	$fln= $fpre =~s/\n/\n/g; ++$fln;
	($fpre=~/\n$/)?($fcol=0):($fcol = length((split(/\n/,$fpre))[-1]));
	my $temp=$fln."\t".$fcol; return ($temp);
}
#=====================================================

#=====================================================
sub _exit_sub
{
	my $msg=shift;
	Win32::MsgBox($msg,64,"Quit");
	exit;
}
#=====================================================



1;
