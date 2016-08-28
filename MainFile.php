                   <?php


//****** mainArray update part ******
$limit=0;
$mainArray=array();
$conn=mysql_connect('localhost','root','');
mysql_select_db("transaction",$conn);
$sql="SELECT * FROM item_list";
$q = mysql_query($sql);
while($row=mysql_fetch_array($q))
{
	$mainArray[$limit]=$row['ITEM'];
	$limit++;
}
sort($mainArray);

// *******calculating support count for c1 ******
			$conn=mysql_connect('localhost','root','');
mysql_select_db("transaction",$conn);
$sql="SELECT * FROM trans";
$q = mysql_query($sql);
$transactionCount=0;
$MINSUPCOUNT=2;
$abc = array(count($mainArray));
$a=0;
for($i=0;$i<count($mainArray);$i++)
{
  $abc[$i]=0;
  $a++;
}

while($row=mysql_fetch_array($q))
{
	$transactionCount++;
  $item = explode(",", $row['item']);
                  for($i=0;$i<count($mainArray);$i++)
                  {
                  if(in_array($mainArray[$i],$item))
                    //if($yala == $mainArray[$i])
                    {
                      $abc[$i]++;
                    }//end of if
                  }//end of for
}//end of while

//**** dsisplay****
echo "<b><u>Total items in main  :</u></b>".$a;  echo "<br/>";echo "<br/>";

for($j=0;$j<count($mainArray);$j++)
{
  echo $mainArray[$j]." appeared in ".$abc[$j]." transactions"; echo "<br/>";
}
$j=0;
$k=1;
${'l'.$k}=array();//array that holds lk+1
${'cl'.$k}=array();//array to hold counter of item that satisfied min support
${'c'.$k}=array();//array for ck+1
${'cp'.($k+1)}=array();//ck+1 after applied apriori property


//****calculating l1****
  for($i=0;$i<count($abc);$i++)
  {
    if($abc[$i]>$MINSUPCOUNT)
    {
       ${'l'.$k}[$j]=array($mainArray[$i]);//  creating l1 as multi-dimensional array .arrray inside array
       ${'cl'.$k}[$j]=$abc[$i]; //array holds counter value of l1
       $j++;
    }
  }
  
echo "<br/>"."<b>total item in main array are </b>".$a;
echo "<br/>";
echo "<br/>"."<h3>the total item in c1 are stored in main array</h3> ";
echo "<h2>total item selected for l1 from c1</h2>"."<br/>";
print_r( ${'l'.$k});
echo "<br/>";
  echo "<h2> l1 generated from  c1 with support count</h2>";
 for($b=0;$b<count(${'l'.$k});$b++)
{
  echo ${'l'.$k}[$b][0]." is selected "." &nbsp;  &nbsp;  &nbsp;".${'cl'.$k}[$b];
  echo "<br/>";
}

//********************(main loop starts from here)**********************************************


//#no 1 generating ck+1

//$k=1;
while(!empty(${'l'.($k)}))
	{
		$y=0;
		$l=0;
//*** generating c2 from l1***	

		if($k==1)
		{

			for($i=0; $i<(count(${'l'.$k})-1);$i++)
				{
				$s=0;
					for($j=($i+1); $j<count(${'l'.$k});$j++)
						{
							${'c'.($k+1)}[$l] = array_unique(array_merge(${'l'.$k}[$i],${'l'.$k}[$j]));
							$l++;
						}
				}
		}

	//*****genedrating ck+1 from lk (k>=2)******
		if($k>=2)
			{		
				for($i=0; $i<count(${'l'.$k});$i++)
					{
						for($j=$i+1; $j<count(${'l'.$k});$j++)
							{
								$s=0;
								$r=0;
								for($a=0; $a<($k-1); $a++)
									{
										if(${'l'.$k}[$i][$a]==${'l'.$k}[$j][$a])
											{
												$s++;
											}
									}
								for($b=$k-1; $b>0; $b--)
									{
										if(${'l'.$k}[$i][$b] == ${'l'.$k}[$j][$b])
											{
												$r++;
											}
									}

								if($s==($k-1)||$r==($k-1))
									{
										${'c'.($k+1)}[$l]= array_values(array_unique(array_merge(${'l'.$k}[$i],${'l'.$k}[$j])));
										$l++;
									}
							}//end of else if
					}// ond of j loop
			echo"<br/>";
			echo "<b> before</b>";
			echo "<br/>";
			print_r(${'c'.($k+1)});
			echo "<br/>";echo "<br/>";echo "<br/>";

			}//end of for loop i
		
$result=array();
$old=array();
$new=array();
//creating subset and checking apriori property
	
			for($i=0; $i<count(${'c'.($k+1)});$i++)
			{
				$z=0;
				$result=${'c'.($k+1)}[$i];
					for($j=0;$j<count($result);$j++)
					{
						$old=array($result[$j]);
						$new=array_values(array_diff($result,$old));
						for($x=0; $x<count(${'l'.$k});$x++)
							{
								if($new==${'l'.$k}[$x])
									{
								$z++;
									}
							}
					}
				
					if($z==count($result))
						{
							${'cp'.($k+1)}[$y]=${'c'.($k+1)}[$i];//update array
							$y++;
						}
			}
echo "<br/>";
echo "<b> after</b>";
echo "<br/>";
print_r(${'cp'.($k+1)});
			
	if(!empty(${'cp'.($k+1)}))
		{
			$su=0;
			${'d'.$k}=array();
			${'cl'.($k+1)}=array();
			${'l'.($k+1)}=array();
			for($i=0; $i<count(${'cp'.($k+1)}); $i++)
				{
  ${'d'.$k}[$i]=0;
  //$d[$i]=0; //initialize counter all counter to 0
  $su++;
}
					$p=0;
					$result=mysql_query("SELECT * FROM trans",$conn);
					while($row=mysql_fetch_array($result))
					{
						$item = explode(",", $row['item']);
						for($i=0;$i<count(${'cp'.($k+1)});$i++)
							{
								$s=0;
								for($j=0;$j<($k+1);$j++)
									{
										if(in_array(${'cp'.($k+1)}[$i][$j],$item))
											{
												$s++;
											}

									}//end of j
					
							if($s==($k+1))
								{
									${'d'.$k}[$i]++;
								}

						}//end of i
					}//end of while
				$j=0;
				//# generating l2
	$r=0;
for($i=0;$i<count(${'d'.$k});$i++)
{
if(${'d'.$k}[$i]>$MINSUPCOUNT)
   {
       ${'l'.($k+1)}[$j]=${'cp'.($k+1)}[$i] ;
       ${'cl'.($k+1)}[$j]= ${'d'.$k}[$i];    $j++; $r++;
   }
}
${'l'.($k+1)}=array_values(${'l'.($k+1)});
echo "<br>";
echo "<br>";
	

	$q=0;
	echo "<b>total item in</b>  "."&nbsp;"."<b>c</b> ".($k+1). "= ".$su;		
		echo"<br/>";
		echo "<br/>";
		echo "<b>total item in</b> "."&nbsp;". "c" .($k+1)."&nbsp;"."<b> with support count</b>";
	 	echo"<br/>";

	for($i=0;$i<count(${'cp'.($k+1)});$i++)
	{
		$p=0;
		for($j=0;$j<count(${'cp'.($k+1)}[$i]);$j++)
	{	
		echo ${'cp'.($k+1)}[$i][$p].",";
		$p++;

		
	}
		echo "appear". ${'d'.$k}[$q]."times";
		
		$q++;
		echo"<br>";

	}
	

	echo "<b>total item in</b> "."&nbsp;". "<b>l</b>".($k+1)."&nbsp;". "<b> selected from</b> "."&nbsp;"."c".($k+1)." ".$r;
	echo"<br/>";
	print_r(${'l'.($k+1)});
	echo"<br/>";
	echo  "<b>l</b>".($k+1)."&nbsp;". " <b>is generated from</b> "."&nbsp;". "<b>c</b>".($k+1) ;
	echo"<br/>";
	echo "<b>the current value of k</b> ".($k+1); echo "<br/>";
	
	}
	$k++;

	}//end of while
	echo "<br>";
	echo "<br>";
	echo "<h2>************* <h2>frequent item set generated </h2>*************</h2>";
	echo "<br>";
	echo "<br>";
	echo "<h2>************* <h2>representative set calculation</h2>*************</h2>";
	
	$repset= array();
	$repvar=0;
	for($i=0; $i<count(${'l'.($k-1)}); $i++)
		{
			${'repset'.$k}[$repvar] = ${'l'.($k-1)}[$i];
			$repvar++;
		}

	while($k>=4)
	{
	echo $k;
	$repvar1=0;
	$l=0;
	$repvar2=0;	
	for($ii=0; $ii<count(${'repset'.$k}); $ii++)
		{	
			${'set'.$ii}=powerSet(${'repset'.$k}[$ii]);
			${'repset'.($k-1)}[$repvar2]=${'repset'.$k}[$ii];
			$repvar2++;
		}
	echo '<br>';
	echo '<br>';
	echo ' current representative set';
	echo '<br>';
	print_r(${'repset'.$k});
	for($i=0; $i<count(${'l'.($k-2)});$i++)
	{
	$flag=0;
	for($j=count(${'repset'.$k})-1;$j>=0;$j--)
	{

	for($s=0; $s<count(${'set'.$j}); $s++)
	{
       if(${'l'.($k-2)}[$i]==${'set'.$j}[$s])
		{
			$kam=${'set'.$j}[count(${'set'.$j})-1];
			//print_r($kam);
			$sam=count($kam);
			//echo $sam;
			$key=array_keys(${'l'.$sam},$kam);
			$ke=$key[0];
			$flag=1;
			if(${'cl'.($k-2)}[$i]>${'cl'.$sam}[$ke])
			{
				${'repset'.($l+1)}[$repvar1]=${'l'.($k-2)}[$i];
				$repvar1++;
				
			}
		}
	}
	if($flag==1)
	{
		$j=-1;
	}
	
}
if($flag==0)
	{
		${'repset'.($l+1)}[$repvar1]=${'l'.($k-2)}[$i];
			$repvar1++;
			$flag=1;

	}
	
}

		for($i=0;$i<count(${'repset'.($l+1)});$i++)
			{
				${'repset'.($k-1)}[$repvar]=${'repset'.($l+1)}[$i];
				$repvar++;
			}
	echo '<br>';echo '<br>';
	echo 'updated repset'.($k-1);
	echo '<br>';echo '<br>';
	print_r(${'repset'.($k-1)});
	echo $k;
	$k--;
	echo '<br>';echo '<br>';
	echo 'loop finished';
	echo '<br>';echo '<br>';
	}//end of while
	echo "<br>";
	echo "<br>";
	
	
	
	/**************************** association starts from here *******************************************************/
	echo "<br>";
	echo "<h2>*************association rule*************</h2>";
	echo "<br>";
	
	
	
	/* ***********************************************SUBSET CALCULATING FUNCTION **********************************/
	$minconf=60;
function powerSet($in,$minLength = 1) 
{ 
   $count = count($in); 
   $members = pow(2,$count); 
   $return = array(); 
   for ($i = 0; $i < $members; $i++) 
   { 
      $b = sprintf("%0".$count."b",$i); 
      $out = array(); 
      for ($j = 0; $j < $count; $j++) { 
         if ($b{$j} == '1') $out[] = $in[$j]; 
   } 
      if (count($out) >= $minLength) 
	  { 
         $return[] = $out; 
      } 
   } 
   return $return; 
}

/*************************************************SUBSET CALCULATING FUNCTION **********************************/


for($i=0; $i<count($repset3); $i++)
{
	${'s'.$i}=powerSet($repset3[$i]);
	
}


/*************************************************DATABASE CONNECTION**************************************/





/************************************************DATABASE CONNECTION****************************************/


$hell=0;

//for($hell=0; $hell<count($l6); $hell++);
while($hell<=count(${'repset'.$k})-1)
{	$u=0;
for($i=0; $i<count(${'s'.$hell}); $i++)
{
  ${'maincounter'.$hell}[$i]=0;
  //$d[$i]=0; //initialize counter all counter to 0
  $u++;
}

$p=0;

  $conn=mysql_connect('localhost','root','');
mysql_select_db("transaction",$conn);
$sql="SELECT * FROM trans";
$q = mysql_query($sql);

$result=mysql_query("SELECT * FROM trans",$conn);

 while($row=mysql_fetch_array($result))
{
  $item = explode(",", $row['item']);


  for($i=0;$i<count(${'s'.$hell});$i++)
	  {

		  $s=0;
		  for($i1=0;$i1<count(${'s'.$hell}[$i]);$i1++)
		  {
                    //print_r(${'c'.$k+1}[$i][$j]);
			  if(in_array(${'s'.$hell}[$i][$i1],$item))
				 {
                                   $s++;	 
				}//end of if

		  }//end of i1
		  if($s==count(${'s'.$hell}[$i]))
		  {
			 ${'maincounter'.$hell}[$i]++;
		  }

	  }//end of i
}//end of while

$select=array();
${'l'.$hell}=array();
$association=array();
$m=0;
for($i=0;$i<count(${'maincounter'.$hell});$i++)
{
	${'l'.$hell}[$i]=${'maincounter'.$hell}[count(${'maincounter'.$hell})-1]/${'maincounter'.$hell}[$i]*100;
}


for($i=0;$i<count(${'maincounter'.$hell});$i++)
{
	if(${'l'.$hell}[$i]>$minconf)
	{
		${'select'.$hell}[$m]=${'s'.$hell}[$i];
		${'sconfidence'.$hell}[$m]=${'l'.$hell}[$i];
		
		$m++;
	}
}

for($i=0;$i<count(${'select'.$hell});$i++)
{
	${'association'.$hell}[$i]=array_values(array_diff($repset3[$hell],${'select'.$hell}[$i]));
}
/*for($i=0;$i<count(${'select'.$hell})-1;$i++)
	{
		print_r(${'select'.$hell}[$i]);echo "====>";print_r(${'association'.$hell}[$i]);echo "====>";print_r(${'sconfidence'.$hell}[$i]);
		echo "<br/>";
	}
	echo "<br/>";echo "<br/>";*/
$hell++;
}//end of while
$n=0;
$x=0;
$y=0;
$leftSide=array();
$rightSide=array();
for($i=0;$i<count(${'repset'.$k})-1;$i++)
	{
		for($j=0;$j<count(${'select'.$i})-1;$j++)

		{
			$leftSide[$n]=${'select'.$i}[$j];
			//$rightSide[$n]=${'association'.$i}[$j]
			$n++;
		}
	}

for($i=0;$i<count(${'repset'.$k})-1;$i++)
	{
		for($j=0;$j<count(${'association'.$i})-1;$j++)

		{
			$rightSide[$x]=${'association'.$i}[$j];
			$x++;
		}
	}
	for($i=0;$i<count(${'repset'.$k})-1;$i++)
	{
		for($j=0;$j<count(${'sconfidence'.$i});$j++)

		{
			$seconfidence[$y]=${'sconfidence'.$i}[$j];
			$y++;
		}
	}
	
for($i=0;$i<count($leftSide);$i++)
	{
		print_r($leftSide[$i]);echo "====>";print_r($rightSide[$i]);echo "====>";print_r($seconfidence[$i]);
		echo "<br/>";echo "<br/>";echo "<br/>";
	}
	echo count($leftSide);
	echo count($rightSide);
?>