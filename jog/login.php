<table cellspacing="0" cellpadding="5" border="0" width="100%">
<tr>
<td align="center" valign="middle">
	<form method="POST" action="login_check.php">
	<table cellspacing="0" cellpadding="5" border="0">		
		<tr>
		<td align="center" valign="top" colspan="3"><br><span class="agak_besar"><b>Log In</b></span></td>
		</tr>
		<tr>
		      <td align="center">Username:<br><input type="text" name="userMasuk" size="16" class="inputpesan"></td>
		</tr>
		<tr>
		      <td align="center">Password:<br><input type="password" name="passMasuk" size="16" class="inputpesan"></td>
		</tr>		
		<tr>
		      <td align="center">
		      <?php echo "<img src=\"../bikinKode.php?string=$cKode\" width=\"50\" height=\"20\">"; ?><br>
		      Silahkan isi kode diatas:<br>
		      <input class="inputpesan" type="text" name="kodeKunci" size="12" maxlength="12" />
		      </td>
		</tr>
		<tr>
		<td align="center" valign="top" colspan="3">
		<input type="hidden" name="hKode" value="<?=$hKode?>" class="tombol" />
		<input type="submit" name="Submit" value="Login" class="tombol" />
		<input type="hidden" name="Submit" value="1" /></td>
		</tr>		
	</table>
	</form>
</td>
</tr>
</table>
<br><br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>

