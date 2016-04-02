
package EasyQC::ErrorLog;
use File::Basename;
use Win32::OLE;
use Win32;
BEGIN { Win32::LoadLibrary("comctl32.dll") }

use Win32::TieRegistry(Delimiter=>"/");
use Tie::IxHash;
use URI::Escape;
use iPerl::Basic qw(_open_file _save_file);

use strict;
use 5.006;
use warnings;
our(@ISA, @EXPORT, $VERSION);
require Exporter;
@ISA = qw(Exporter);
@EXPORT = qw(CreateErrorLog AddErrWarn GetLineCol GetLineCol1 ParseXML CreateErrorLogfromParseContent GetErrorsFromParseContent CreateErrorLogfromTxtLog ExitSub AddLabel AddSubLabel ErrorReturn CreateErrorLog4ErrorReturn HtmlTableValidate OpenFile1 SaveFile1 AddFolderErr WellformCheck WellformCheck_String);
$VERSION = "1.0";
my $linkcount=0;
