<?php
$mobile_browser = false;
if(isMobile()){
		$mobile_browser = true;
	}
	else{
		$mobile_browser = false;
	}
?>
<!DOCTYPE html>
	<br/>

			<div class="modal-footer">
				<p align="center"><font size="5px" color="white">Please help us to indentify the unknown songs and albums</font></p><br/>
				<p align="center"><a class="btn btn-large btn-primary" href="contact-us.php">Contact Us</a></p><hr/>
				<p align="center">
					<font size="2px" color="white">
						<?php
							if($mobile_browser)
							{
						?>
								<a style="text-decoration:none" href='show-all.php?recent=yes'>Recently Added</a> |
								<a style="text-decoration:none" href='show-all.php?show=Devotional'>Devotional</a> |
								<a style="text-decoration:none" href='show-all.php?show=0'>Albums</a> |
								<a style="text-decoration:none" href='show-all.php?show=Modern'>Modern</a> |
								<a style="text-decoration:none" href='show-all.php?show=Unknown'>Unknown</a> |
						<?php						
							}
							else
							{
						?>
								<a style="text-decoration:none" href="album-wise.php?code=559&access=1">Recently Added</a> |
								<a style="text-decoration:none" href="album-wise.php?album_type=Devotional">Devotional</a> |
								<a style="text-decoration:none" href="album-wise.php">Albums/Films</a> |
								<a style="text-decoration:none" href="album-wise.php?album_type=Modern">Modern</a> |
								<a style="text-decoration:none" href="album-wise.php?album_type=Unknown">Unknown</a>
						<?php
							}
						?>
						
					</font>
				</p>
	<?php
		if(!$mobile_browser)
		{
	?>
			<div class="row">
				<div class="span4" align="center">
					<a href="http://www.kaakai.in"><img title='KAAKAI Newspaper' src="img/logo/kaakai_logo_white.png" width="150"></a>
				</div>
				<!--
					<div class="span3" align="center">
						 <a href="radio.php"><img title='BM Radio' src="img/logo/radio.png" width="80"></a> 
					</div>
				-->
				<div class="span4" align="center">
					<br/>
					<a href="index.php"><img title='Amar Ela' src="img/logo/inverted_amarela_logo.png" width="140"></a>
				</div>
				<div class="span4" align="center">
					<a href="http://en.wikipedia.org/wiki/KAAKAI_Newspaper"><img title='KAAKAI wiki page' src="img/logo/wiki.png" width="80"></a>
				</div>
			</div>
			
			<p class="pull-right"><a href="#">Back to top</a></p>
			<p align="center">&copy; 2014 &middot;  <a href='http://amarela.kaakai.in'>amarela.kaakai.in</a> under <a href='http://kaakai.in'>KAAKAI</a> Newspaper. All rights are reserved .
		
	<?php
		}
		else
		{
	?>
			<div class="container">
				<div class="row">
					<div class="span12" align="center">
						<div class="row">
							<div class="span3" align="center">
								<a href="http://www.kaakai.in"><img src="img/logo/kaakai_logo_white.png" width="70"></a>
							</div>
							<div class="span3" align="center">
								<!-- <a href="radio.php"><img src="img/logo/radio.png" width="30"></a> -->
							</div>
							
							<div class="span3" align="center">
								<a href="index.php"><img src="img/logo/inverted_amarela_logo.png" width="70"></a>
							</div>
							<div class="span3" align="center">
								<a href="http://en.wikipedia.org/wiki/KAAKAI_Newspaper"><img src="img/logo/wiki.png" width="30"></a>
							</div>
						</div>
					</div>
				</div>
			</div>				
				<font color='white'><p align="center">&copy; 2014 &middot;  <a href='http://amarela.kaakai.in'>amarela.kaakai.in</a> under <a href='http://kaakai.in'>KAAKAI</a> Newspaper. All rights are reserved.</font>
	<?php
		}
	?>
	</div>


                            
                            
                            