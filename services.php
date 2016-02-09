ssddssd
sdg
sds
dfds
=head2 Tables

=head3 _cals_table_conversion

	This is the method used to Convert iCore HTML table to Cals Table.

	Function Name  : _cals_table_conversion(<fileContent>, <paraTagClanFlag>, [<nameSpace>])
	Arguments      : Arg1 => File All Content, Arg2 => Para tag clean flag 0 - retain, 1 - Remove, Arg3 => Prefix namespace for each table element(Optional)
	Return         : Cals table converted content 
	Usage          : my $content = _cals_table_conversion($content, 1, "oasis");

=cut

sub _cals_table_conversion
{
	my $cnt = shift;
	my $para_clean_flag = shift;
	my $namespace = "";
	$namespace = shift if(defined($_[0]) and $_[0] !~ m{^\s*$});
	
	$cnt =~ s{<table-wrap (?:(?!<\/?table-wrap[ >]).)*</table-wrap>}{_convert_cals_table($&, $para_clean_flag, $namespace)}isge;
	$cnt =~ s{<table (?:(?!<\/?table[ >]).)*</table>}{_convert_cals_table($&, $para_clean_flag, $namespace)}isge;
	$cnt =~ s/(<\/?)table1([ >])/$1table$2/gi;
	return $cnt;
}
