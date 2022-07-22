<?php

include('../main/base.php');
include('house_needs_inventory_edit_top.php');?>

<style>.col-column, body{ overflow-y:scroll; overflow-x;hidden;}table{width:100%; background:#219bc3;}table th, table td{width:50%;}td>.form-control{background:lightpink; font-size:18px; text-transform: capitalize;}th>.form-control{font-weight:bold; font-size:18px; text-transform: capitalize;}.cover{background: linear-gradient(45deg, #20bf6b, #0088cc, #ebf8e1 70%, #f89406, white);}body, .col-column-inventory{/*overflow:hidden;*/ overflow-anchor:none;}.bg-light{background-color:#219bc3!important;}#logo{color:yellow;}@media(max-width:600px){.col-sm-12, .col-md-12{padding:0;}html{overflow-x:hidden;}}

</style>
</head>
<?php include( '../main/navbar.php'); ?>
<!-- <main class=""> -->
  <main class="col-column-inventory">
		<section id="mid-edit">
			<form action="" method="post">
				<header class="row">
					<div class="col-sm-12 col-md-12">
						<div style="padding:21px">
							<p style="display:inline-block"><a class="btn btn-sm btn-primary" href="house_needs_inventory?inventory=<?php echo $inventory_name; ?>">Back</a>
							</p>
							<button class="btn btn-sm btn-warning" type="submit" id="update" name="update" width="120">Submit Update</button>
							<p style="font-size:15px;color:#555;">Maximum of 21 Letters including space on each input</p>
						</div>
					</div>
				</header>
				<table border="0" cellpadding="3" cellspacing="0">
					<tr>
						<th class="text-center text-white">Item Name</th>
						<th class="text-center text-white">Qty or Description</th>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_acon" name="inv_acon" placeholder="Item name" value="<?php echo $inv_acon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_ades" name="inv_ades" placeholder="quantity" value="<?php echo $inv_ades; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_bcon" name="inv_bcon" placeholder="Item name" value="<?php echo $inv_bcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_bdes" name="inv_bdes" placeholder="quantity" value="<?php echo $inv_bdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_ccon" name="inv_ccon" placeholder="Item name" value="<?php echo $inv_ccon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_cdes" name="inv_cdes" placeholder="quantity" value="<?php echo $inv_cdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_dcon" name="inv_dcon" placeholder="Item name" value="<?php echo $inv_dcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_ddes" name="inv_ddes" placeholder="quantity" value="<?php echo $inv_ddes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_econ" name="inv_econ" placeholder="Item name" value="<?php echo $inv_econ; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_edes" name="inv_edes" placeholder="quantity" value="<?php echo $inv_edes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_fcon" name="inv_fcon" placeholder="Item name" value="<?php echo $inv_fcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_fdes" name="inv_fdes" placeholder="quantity" value="<?php echo $inv_fdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_gcon" name="inv_gcon" placeholder="Item name" value="<?php echo $inv_gcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_gdes" name="inv_gdes" placeholder="quantity" value="<?php echo $inv_gdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_hcon" name="inv_hcon" placeholder="Item name" value="<?php echo $inv_hcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_hdes" name="inv_hdes" placeholder="quantity" value="<?php echo $inv_hdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_icon" name="inv_icon" placeholder="Item name" value="<?php echo $inv_icon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_ides" name="inv_ides" placeholder="quantity" value="<?php echo $inv_ides; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_jcon" name="inv_jcon" placeholder="Item name" value="<?php echo $inv_jcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_jdes" name="inv_jdes" placeholder="quantity" value="<?php echo $inv_jdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_kcon" name="inv_kcon" placeholder="Item name" value="<?php echo $inv_kcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_kdes" name="inv_kdes" placeholder="quantity" value="<?php echo $inv_kdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_lcon" name="inv_lcon" placeholder="Item name" value="<?php echo $inv_lcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_ldes" name="inv_ldes" placeholder="quantity" value="<?php echo $inv_ldes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_mcon" name="inv_mcon" placeholder="Item name" value="<?php echo $inv_mcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_mdes" name="inv_mdes" placeholder="quantity" value="<?php echo $inv_mdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_ncon" name="inv_ncon" placeholder="Item name" value="<?php echo $inv_ncon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_ndes" name="inv_ndes" placeholder="quantity" value="<?php echo $inv_ndes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_ocon" name="inv_ocon" placeholder="Item name" value="<?php echo $inv_ocon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_odes" name="inv_odes" placeholder="quantity" value="<?php echo $inv_odes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_pcon" name="inv_pcon" placeholder="Item name" value="<?php echo $inv_pcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_pdes" name="inv_pdes" placeholder="quantity" value="<?php echo $inv_pdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_qcon" name="inv_qcon" placeholder="Item name" value="<?php echo $inv_qcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_qdes" name="inv_qdes" placeholder="quantity" value="<?php echo $inv_qdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_rcon" name="inv_rcon" placeholder="Item name" value="<?php echo $inv_rcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_rdes" name="inv_rdes" placeholder="quantity" value="<?php echo $inv_rdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_scon" name="inv_scon" placeholder="Item name" value="<?php echo $inv_scon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_sdes" name="inv_sdes" placeholder="quantity" value="<?php echo $inv_sdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_tcon" name="inv_tcon" placeholder="Item name" value="<?php echo $inv_tcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_tdes" name="inv_tdes" placeholder="quantity" value="<?php echo $inv_tdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_ucon" name="inv_ucon" placeholder="Item name" value="<?php echo $inv_ucon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_udes" name="inv_udes" placeholder="quantity" value="<?php echo $inv_udes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_vcon" name="inv_vcon" placeholder="Item name" value="<?php echo $inv_vcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_vdes" name="inv_vdes" placeholder="quantity" value="<?php echo $inv_vdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_wcon" name="inv_wcon" placeholder="Item name" value="<?php echo $inv_wcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_wdes" name="inv_wdes" placeholder="quantity" value="<?php echo $inv_wdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_xcon" name="inv_xcon" placeholder="Item name" value="<?php echo $inv_xcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_xdes" name="inv_xdes" placeholder="quantity" value="<?php echo $inv_xdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_ycon" name="inv_ycon" placeholder="Item name" value="<?php echo $inv_ycon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_ydes" name="inv_ydes" placeholder="quantity" value="<?php echo $inv_ydes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="inv_zcon" name="inv_zcon" placeholder="Item name" value="<?php echo $inv_zcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="inv_zdes" name="inv_zdes" placeholder="quantity" value="<?php echo $inv_zdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="aacon" name="aacon" placeholder="Item name" value="<?php echo $aacon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="aades" name="aades" placeholder="quantity" value="<?php echo $aades; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="abcon" name="abcon" placeholder="Item name" value="<?php echo $abcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="abdes" name="abdes" placeholder="quantity" value="<?php echo $abdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="accon" name="accon" placeholder="Item name" value="<?php echo $accon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="acdes" name="acdes" placeholder="quantity" value="<?php echo $acdes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="adcon" name="adcon" placeholder="Item name" value="<?php echo $adcon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="addes" name="addes" placeholder="quantity" value="<?php echo $addes; ?>" />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="aecon" name="aecon" placeholder="Item name" value="<?php echo $aecon; ?>" />
						</th>
						<td>
							<input class="form-control" type="text" id="aedes" name="aedes" placeholder="quantity" value="<?php echo $aedes; ?>"  />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="afcon" name="afcon" placeholder="Item name" value="<?php echo $afcon; ?>"  />
						</th>
						<td>
							<input class="form-control" type="text" id="afdes" name="afdes" placeholder="quantity" value="<?php echo $afdes; ?>"  />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="agcon" name="agcon" placeholder="Item name" value="<?php echo $agcon; ?>"  />
						</th>
						<td>
							<input class="form-control" type="text" id="agdes" name="agdes" placeholder="quantity" value="<?php echo $agdes; ?>"  />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="ahcon" name="ahcon" placeholder="Item name" value="<?php echo $ahcon; ?>"  />
						</th>
						<td>
							<input class="form-control" type="text" id="ahdes" name="ahdes" placeholder="quantity" value="<?php echo $ahdes; ?>"  />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="aicon" name="aicon" placeholder="Item name" value="<?php echo $aicon; ?>"  />
						</th>
						<td>
							<input class="form-control" type="text" id="aides" name="aides" placeholder="quantity" value="<?php echo $aides; ?>"  />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="ajcon" name="ajcon" placeholder="Item name" value="<?php echo $ajcon; ?>"  />
						</th>
						<td>
							<input class="form-control" type="text" id="ajdes" name="ajdes" placeholder="quantity" value="<?php echo $ajdes; ?>"  />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="akcon" name="akcon" placeholder="Item name" value="<?php echo $akcon; ?>"  />
						</th>
						<td>
							<input class="form-control" type="text" id="akdes" name="akdes" placeholder="quantity" value="<?php echo $akdes; ?>"  />
						</td>
					</tr>
					<tr>
						<th>
							<input class="form-control" type="text" id="alcon" name="alcon" placeholder="Item name" value="<?php echo $alcon; ?>"  />
						</th>
						<td>
							<input class="form-control" type="text" id="aldes" name="aldes" placeholder="quantity" value="<?php echo $aldes; ?>"  />
						</td>
					</tr>
				</table>
			</form>
		</section>
</main>
<!-- </main> -->
<p>&nbsp;</p>
</body>

</html>
