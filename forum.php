<?php
 
# using python script
# get current server, grpname, grpstatus
$command="python python/cluster2_grp.py";
exec($command,$output);

$output[1] = str_replace('current','',$output[1]);
$crtgrpsrv2 = str_replace(':','',$output[1]);

$grpname2 = substr($output[2], 0, strcspn($output[2], ' '));

$output[2] = str_replace($grpname2,'',$output[2]);
$grpstatus2 = str_replace(':','',$output[2]);

if (strpos($crtgrpsrv2, "server3") !== false) {
	$fgstatus_srv3 = $grpstatus2;
	$fgstatus_srv4 = '-';
} else if (strpos($crtgrpsrv2, "server4") !== false) {
	$fgstatus_srv3 = '-';
	$fgstatus_srv4 = $grpstatus2;
} else if (strpos($crtgrpsrv2, "None") !== false) {
	$fgstatus_srv3 = $fgstatus_srv4 = '-';
} else {
	$fgstatus_srv3 = $fgstatus_srv4 = 'cannot get status';
}

#get srvname, srvstatus
$command="python python/cluster2_srv.py";
exec($command,$output2);

$z = 1;
for ($i = 3; $i <= 4; $i++) {
	${'srvname'.$i} = substr($output2[$z], 0, strcspn($output2[$z], ' '));
	$output2[$z] = str_replace(${'srvname'.$i},'',$output2[$z]);
	${'srvstatus'.$i} = str_replace(':','',$output2[$z]);
	${'srvstatus'.$i} = ltrim(${'srvstatus'.$i});
	//if (strcmp(${'srvstatus'.$i}, "Offline") == 0) {
	//	${'srvstatus'.$i} = "-";
	//}
	$z++;
}

#get clustername and clusterstatus
$command="python python/cluster2_cls.py";
exec($command,$output3);

$clsname2 = substr($output3[1], 0, strcspn($output3[1], ' '));
$output3[1] = str_replace($clsname2,'',$output3[1]);
$clsstatus2 = str_replace(':','',$output3[1]);

#get rscname, rscstatus
$command="python python/cluster2_rsc.py";
exec($command,$output4);

$z = 1;
for ($i = 1; $i <= 3; $i++) {
	$output4[$z] = str_replace('current','',$output4[$z]);
	${'crtrscsrv2_'.$i} = str_replace(':','',$output4[$z]);
	$z++;
	
	${'rscname2_'.$i} = substr($output4[$z], 0, strcspn($output4[$z], ' '));
	$output4[$z] = str_replace(${'rscname2_'.$i},'',$output4[$z]);
	$output4[$z] = str_replace(':','',$output4[$z]);

	if (strpos(${'crtrscsrv2_'.$i}, "server3") !== false) {
		${'rscstatus2_'.$i.'_1'} = $output4[$z];
		${'rscstatus2_'.$i.'_2'} = '-';
	} else if (strpos(${'crtrscsrv1_'.$i}, "server4") !== false) {
		${'rscstatus2_'.$i.'_1'} = '-';
		${'rscstatus2_'.$i.'_2'} = $output4[$z];
	} else if (strpos(${'crtrscsrv1_'.$i}, "None") !== false) {
		${'rscstatus2_'.$i.'_1'} = ${'rscstatus2_'.$i.'_2'} = '-';
	} else {
		${'rscstatus2_'.$i.'_1'} = ${'rscstatus2_'.$i.'_2'} = 'cannot get status';		
	}
	$z++;
}

#get monname, monstatus
$command="python python/cluster2_mon.py";
exec($command,$output5);

$z = 1;
for ($i = 1; $i <= 5; $i++) {
	if ($z % 3 == 1) {
		${'monname2_'.$i} = substr($output5[$z], 0, strcspn($output5[$z], ' '));
		$z++;
	} 
	for ($j = 1; $j <= 2; $j++) {
		if($z % 3 != 1) {
			$s = $j + 2;
			$output5[$z] = str_replace(${'srvname'.$s},'',$output5[$z]);
			${'monstatus2_'.$i.'_'.$j} = str_replace(':','',$output5[$z]);
			${'monstatus2_'.$i.'_'.$j} = ltrim(${'monstatus2_'.$i.'_'.$j});
			if (strcmp(${'monstatus2_'.$i.'_'.$j}, "Offline") == 0) {
				${'monstatus2_'.$i.'_'.$j} = "-";
			}
			$z++;
		}
	}
}
# using python script
# get current server, grpname, grpstatus
$command="python python/cluster_grp.py";
exec($command,$output6);

$output6[1] = str_replace('current','',$output6[1]);
$crtgrpsrv1 = str_replace(':','',$output6[1]);

$grpname1 = substr($output6[2], 0, strcspn($output6[2], ' '));

$output6[2] = str_replace($grpname1,'',$output6[2]);
$grpstatus1 = str_replace(':','',$output6[2]);

if (strpos($crtgrpsrv1, "server1") !== false) {
	$fgstatus_srv1 = $grpstatus1;
	$fgstatus_srv2 = '-';
} else if (strpos($crtgrpsrv1, "server2") !== false) {
	$fgstatus_srv1 = '-';
	$fgstatus_srv2 = $grpstatus1;
} else if (strpos($crtgrpsrv1, "None") !== false) {
	$fgstatus_srv1 = $fgstatus_srv2 = '-';
} else {
	$fgstatus_srv1 = $fgstatus_srv2 = 'cannot get status';
}

#get srvname, srvstatus
$command="python python/cluster_srv.py";
exec($command,$output7);

$z = 1;
for ($i = 1; $i <= 2; $i++) {
	${'srvname'.$i} = substr($output7[$z], 0, strcspn($output7[$z], ' '));
	$output7[$z] = str_replace(${'srvname'.$i},'',$output7[$z]);
	${'srvstatus'.$i} = str_replace(':','',$output7[$z]);
	${'srvstatus'.$i} = ltrim(${'srvstatus'.$i});
	//if (strcmp(${'srvstatus'.$i}, "Offline") == 0) {
	//	${'srvstatus'.$i} = "-";
	//}
	$z++;
}

#get clustername and clusterstatus
$command="python python/cluster_cls.py";
exec($command,$output8);

$clsname1 = substr($output8[1], 0, strcspn($output8[1], ' '));
$output8[1] = str_replace($clsname1,'',$output8[1]);
$clsstatus1 = str_replace(':','',$output8[1]);

#get rscname, rscstatus
$command="python python/cluster_rsc.py";
exec($command,$output9);

$z = 1;
for ($i = 1; $i <= 3; $i++) {
	$output9[$z] = str_replace('current','',$output9[$z]);
	${'crtrscsrv1_'.$i} = str_replace(':','',$output9[$z]);
	$z++;
	
	${'rscname1_'.$i} = substr($output9[$z], 0, strcspn($output9[$z], ' '));
	$output9[$z] = str_replace(${'rscname1_'.$i},'',$output9[$z]);
	$output9[$z] = str_replace(':','',$output9[$z]);

	if (strpos(${'crtrscsrv1_'.$i}, "server1") !== false) {
		${'rscstatus1_'.$i.'_1'} = $output9[$z];
		${'rscstatus1_'.$i.'_2'} = '-';
	} else if (strpos(${'crtrscsrv1_'.$i}, "server2") !== false) {
		${'rscstatus1_'.$i.'_1'} = '-';
		${'rscstatus1_'.$i.'_2'} = $output9[$z];
	} else if (strpos(${'crtrscsrv1_'.$i}, "None") !== false) {
		${'rscstatus1_'.$i.'_1'} = ${'rscstatus1_'.$i.'_2'} = '-';
	} else {
		${'rscstatus1_'.$i.'_1'} = ${'rscstatus1_'.$i.'_2'} = 'cannot get status';		
	}
	$z++;
}

#get monname, monstatus
$command="python python/cluster_mon.py";
exec($command,$output10);

$z = 1;
for ($i = 1; $i <= 5; $i++) {
	if ($z % 3 == 1) {
		${'monname1_'.$i} = substr($output10[$z], 0, strcspn($output10[$z], ' '));
		$z++;
	} 
	for ($j = 1; $j <= 2; $j++) {
		if($z % 3 != 1) {
			$output10[$z] = str_replace(${'srvname'.$j},'',$output10[$z]);
			${'monstatus1_'.$i.'_'.$j} = str_replace(':','',$output10[$z]);
			${'monstatus1_'.$i.'_'.$j} = ltrim(${'monstatus1_'.$i.'_'.$j});
			if (strcmp(${'monstatus1_'.$i.'_'.$j}, "Offline") == 0) {
				${'monstatus1_'.$i.'_'.$j} = "-";
			}
			$z++;
		}
	}
}

?>
 
<!DOCTYPE html>
<html>
<head>
<title>CLUSTERPRO FORUM 2020</title>
<meta charset="utf-8">
</head>
<body>

<h1> CLUSTERPRO Information </h1>


<font size=5> 
<table border='0'>
<td valign="top">
	<table border='1' style="float:left;margin:25px;">
		<h3> <?php echo $clsname1 ?> is <?php echo $clsstatus1 ?> </h3>
		<tr><th> </th> <th><?php echo $srvname1 ?></th><th><?php echo $srvname2 ?></th></tr>
		<tr><th> status </th> <th><?php echo $srvstatus1 ?></th> <th><?php echo $srvstatus2 ?></th> </tr>
		<tr><th> <?php echo $grpname1 ?> </th> <th><?php echo $fgstatus_srv1 ?></th> <th><?php echo $fgstatus_srv2 ?></th> </tr>
		<tr><td align="right"> <?php echo $rscname1_1 ?> </td> <th><?php echo $rscstatus1_1_1 ?></th> <th><?php echo $rscstatus1_1_2 ?></th> </tr>
		<tr><td align="right"> <?php echo $rscname1_2 ?> </td> <th><?php echo $rscstatus1_2_1 ?></th> <th><?php echo $rscstatus1_2_2 ?></th> </tr>
		<tr><td align="right"> <?php echo $rscname1_3 ?> </td> <th><?php echo $rscstatus1_3_1 ?></th> <th><?php echo $rscstatus1_3_2 ?></th> </tr>
		<tr><th> <?php echo $monname1_1 ?> </th> <th><?php echo $monstatus1_1_1 ?></th> <th><?php echo $monstatus1_1_2 ?></th> </tr>
		<tr><th> <?php echo $monname1_2 ?> </th> <th><?php echo $monstatus1_2_1 ?></th> <th><?php echo $monstatus1_2_2 ?></th> </tr>
		<tr><th> <?php echo $monname1_3 ?> </th> <th><?php echo $monstatus1_3_1 ?></th> <th><?php echo $monstatus1_3_2 ?></th> </tr>
		<tr><th> <?php echo $monname1_4 ?> </th> <th><?php echo $monstatus1_4_1 ?></th> <th><?php echo $monstatus1_4_2 ?></th> </tr>
		<tr><th> <?php echo $monname1_5 ?> </th> <th><?php echo $monstatus1_5_1 ?></th> <th><?php echo $monstatus1_5_2 ?></th> </tr>
	</table>
</td>
<td valign="top">
	<table border='1' style="float:right;margin:25px;">
		<h3> <?php echo $clsname2 ?> is <?php echo $clsstatus2 ?> </h3>
		<tr><th> </th> <th><?php echo $srvname3 ?></th><th><?php echo $srvname4 ?></th></tr>
		<tr><th> status </th> <th><?php echo $srvstatus3 ?></th> <th><?php echo $srvstatus4 ?></th> </tr>
		<tr><th> <?php echo $grpname2 ?> </th> <th><?php echo $fgstatus_srv3 ?></th> <th><?php echo $fgstatus_srv4 ?></th> </tr>
		<tr> <td align="right"> <?php echo $rscname2_1 ?> </td> <th><?php echo $rscstatus2_1_1 ?></th> <th><?php echo $rscstatus2_1_2 ?></th> </tr>
		<tr> <td align="right"> <?php echo $rscname2_2 ?> </td> <th><?php echo $rscstatus2_2_1 ?></th> <th><?php echo $rscstatus2_2_2 ?></th> </tr>
		<tr> <td align="right"> <?php echo $rscname2_3 ?> </td> <th><?php echo $rscstatus2_3_1 ?></th> <th><?php echo $rscstatus2_3_2 ?></th> </tr>
		<tr><th> <?php echo $monname2_1 ?> </th> <th><?php echo $monstatus2_1_1 ?></th> <th><?php echo $monstatus2_1_2 ?></th> </tr>
		<tr><th> <?php echo $monname2_2 ?> </th> <th><?php echo $monstatus2_2_1 ?></th> <th><?php echo $monstatus2_2_2 ?></th> </tr>
		<tr><th> <?php echo $monname2_3 ?> </th> <th><?php echo $monstatus2_3_1 ?></th> <th><?php echo $monstatus2_3_2 ?></th> </tr>
		<tr><th> <?php echo $monname2_4 ?> </th> <th><?php echo $monstatus2_4_1 ?></th> <th><?php echo $monstatus2_4_2 ?></th> </tr>
		<tr><th> <?php echo $monname2_5 ?> </th> <th><?php echo $monstatus2_5_1 ?></th> <th><?php echo $monstatus2_5_2 ?></th> </tr>
	</table>
</td>
</font>

<FORM>
<INPUT TYPE="image" src="image/kurara3.png" VALUE="reload"onClick="window.location.reload(); "style="position: absolute; right: 0px; top: 0px"/>
</FORM>

</body>
</html>
