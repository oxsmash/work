<?
ob_start();
session_start();
//include("header.php")
?>		
<link rel="stylesheet" type="text/css" media="all" href="calendar_files/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendar_files/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="calendar_files/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendar_files/calendar-setup.js"></script>
				&nbsp;&nbsp;<span class="judul_menu">Grafik Transaksi ::</span>

				<br />
				<br />
<form action="listTransaksi.php" method="get">
<table cellpadding="0" cellspacing="0" border="0">
<tr><td>Konsumen</td><td>:</td><td>
				<select name="aaa" class="inputpesan">
									<option value="0">Semua Konsumen</option>
									<option value="1">Single Customer</option>
									<option value="2">KErabat Costomer</option>
									<option value="3">Rombongan</option>
				</select>
	</td></tr>
<tr><td>Kota</td><td>:</td><td>
				<select name="kota" class="inputpesan">
									<option value="0">Semua Kota</option>
									<option value="1" >Bali</option>
														<option value="2" >Bangka Belitung</option>
														<option value="3" >Banten</option>
														<option value="4" >Bengkulu</option>
														<option value="5" >D.I Aceh</option>
														<option value="6" selected>D.I Yogyakarta</option>
														<option value="7" >DKI Jakarta</option>
														<option value="8" >Gorontalo</option>
														<option value="9" >Irian Jaya Barat</option>
														<option value="10" >Irian Jaya Tengah</option>
														<option value="11" >Irian Jaya Timur</option>
														<option value="12" >Jambi</option>
														<option value="13" >Jawa Barat</option>
														<option value="14" >Jawa Tengah</option>
														<option value="15" >Jawa Timur</option>
														<option value="16" >Kalimantan Barat</option>
														<option value="17" >Kalimantan Selatan</option>
														<option value="18" >Kalimantan Tengah</option>
														<option value="19" >Kalimantan Timur</option>
														<option value="20" >Lampung</option>
														<option value="21" >Maluku</option>
														<option value="22" >Maluku Utara</option>
														<option value="23" >Nusa Tenggara Barat</option>
														<option value="24" >Nusa Tenggara Timur</option>
														<option value="28" >Propinsi Sulawesi Tenggara</option>
														<option value="25" >Riau</option>
														<option value="26" >Sulawesi Selatan</option>
														<option value="27" >Sulawesi Tengah</option>
														<option value="29" >Sulawesi Utara</option>
														<option value="30" >Sumatera Selatan</option>
														<option value="31" >Sumatrea Barat</option>
														<option value="32" >Sumatrea Utara</option>
														<option value="100" >Luar Negeri</option>
				</select>
	</td></tr>
<tr><td>Tanggal</td><td>:</td><td>
										<input type="text" name="date1" id="f_date_a" value="2007-05-01" size="10" class="inputpesan" Readonly/><button type="reset" class="tombol2" id="f_trigger_a">...</button>				
											<script type="text/javascript">
											    Calendar.setup({
											        inputField     :    "f_date_a",      // id of the input field
											        ifFormat       :    "%Y-%m-%d",       // format of the input field
											        showsTime      :    false,            // will display a time selector
											        button         :    "f_trigger_a",   // trigger for the calendar (button ID)
											        singleClick    :    true,           // double-click mode
											        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
											    });
											</script>
											-
											<input type="text" name="date2" id="f_date_b" value="2007-05-07" size="10" class="inputpesan" Readonly/><button type="reset" class="tombol2" id="f_trigger_b">...</button>

											<script type="text/javascript">
											    Calendar.setup({
											        inputField     :    "f_date_b",      // id of the input field
											        ifFormat       :    "%Y-%m-%d",       // format of the input field
											        showsTime      :    false,            // will display a time selector
											        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
											        singleClick    :    true,           // double-click mode
											        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
											    });
											</script>
	
<input type="hidden" name="cHidden" value="1"> 
<input type="submit" name="cSubmit" value="Cari" class="tombol"></td></tr>
</table>
</form>
				<?
				$dataY="200000,150000,320000,439500,450000,319000,287500";
				$dataX="01-05-2007,02-05-2007,03-05-2007,04-05-2007,05-05-2007,06-05-2007,07-05-2007";
				$judulGrafik="Grafik Penjualan";		
				$subjudulGrafik="1 Mei 2007 - 7 Mei 2007";										
				session_register("judulGrafik");
				session_register("dataX");
				session_register("dataY");
				session_register("subjudulGrafik");
				$judultanggal="Date";
				session_register("judultanggal");
				?>				
					<img src="grafik_bar.php?subTitle=<?=$subTitle;?>&dataX=<?=$dataX;?>&dataY=<?=$dataY;?>" alt="" />
					<!--sisi kanan selesai-->
<?
//include("footer.php")
?>		