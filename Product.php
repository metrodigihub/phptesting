# Global variables
	my $dirname = $ARGV[0];
	$dirname =~ s{\\$}{}ig;
	my @all_files = _get_file_list($dirname,1,1,'\.xml$');

# do Conversion process

	my (@isbn, @filename, @tablecount) = ("", "", "");
	my ($tabcount, $filename) = ("", "");
	foreach my $xmlfile (@all_files){
		my $cnt = _open_file("$xmlfile");
		$filename = basename($xmlfile);
		$filename =~ s{\.[^\.]*$}{}i;
		push(@filename, $filename);
		push(@isbn, $1) if($cnt =~ m{<book-id(?: [^>]+)? pub-id-type="publisher-id"[^><]*>((?:(?!</?book-id[ >]).)*)</book-id>}is);
		$tabcount = $cnt =~ s{<table-wrap(?: [^>]+)?>}{$&}isg;
		push(@tablecount, $tabcount);
	}
	@isbn = grep /\S/, @isbn;
	
	# use Excel::Writer::XLSX;
	my $file = "$dirname\\WKI_TableCount.xls";
	
	# use Win32::OLE;

	# use existing instance if Excel is already running
	my ($ex, $book, $sheet, $array) = "";
	
	eval {$ex = Win32::OLE->GetActiveObject('Excel.Application')};
	die "Excel not installed" if $@;
	unless (defined $ex) {
		$ex = Win32::OLE->new('Excel.Application', sub {$_[0]->Quit;})
				or die "Oops, cannot start Excel";
	}

	# get a new workbook
	$book = $ex->Workbooks->Add;

	# write to a particular cell
	$sheet = $book->Worksheets(1);
	$sheet->Cells(1,1)->{value} = "ISBN";
	$sheet->Cells(1,2)->{Value} = "Filename";
	$sheet->Cells(1,3)->{Value} = "Tablecount";
	
	my $i = 0; my $r = 2;
	foreach my $row (1..scalar(@filename)){
		$sheet->Cells($r,1)->{Value} = "$isbn[$i]";		
		$sheet->Cells($r,2)->{Value} = "$filename[$i]";
		$sheet->Cells($r,3)->{Value} = "$tablecount[$i]";
		++$i; ++$r;
	}	
	
	for (@$array) {
		for (@$_) {
			print defined($_) ? "$_|" : "<undef>|";
		}
		print "\n";
	}

	# save and exit
	$book->SaveAs("$file");
	undef $book;
	undef $ex;
	
	
  
	 # _save_file("$file", "$mid");	 
	 
	print "Process Completed...!!!";exit;
	
	
