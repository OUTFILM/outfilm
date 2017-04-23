					<?php 
						$query_top = "Select Link,Catalog_Order FROM catalog,top_spotlight WHERE catalog.Catalog_Id = top_spotlight.Catalog_Id LIMIT 3";
						$result_t = mysqli_query($mysqli, $query_top);
						if (!$result_t) { // add this check.
    						die('Invalid query: ' . mysqli_error());}
						while (is_array($row = mysqli_fetch_array($result_t))) {					 		
							?><div class="slide" id="<?php echo "slide"."$row[Catalog_Order]"; ?>" <?php if($row['Catalog_Order']== 0) echo "style=\"display: block;\"";?> > <img src=" <?php echo "$row[Link]"; ?>/> </div>
					<?php			
						}
					?>" 
					


				<div class="slide" id="slide0" style="display: block;"><img src="http://www.out.com/sites/out.com/files/bo8a8771.jpg"/> </div>		
				<div class="slide" id="slide1"><img src="http://www.out.com/sites/out.com/files/bo8a8771.jpg"/> </div>	
				<div class="slide" id="slide2"><img src="http://www.out.com/sites/out.com/files/bo8a8771.jpg"/> </div>
				
<div class="Tag_display" id="Tag0" style="display: block;">
					<p>Tag0 Example</p>
				</div>
				<div class="Tag_display" id="Tag1"><p>Tag1</p></div>
				<div class="Tag_display" id="Tag2"><p>Tag2</p></div>
				

					<div id="headline" style="text-align: center;">
						<p><h2>Andreja Pejic Makes Vogue History</h2></p>
					</div>
					
					<div id="Article_spot" style="text-align: center;">
						Andreja Pejic is the first transgender model to be profiled in the pages of American Vogue.

APRIL 21 2015 2:45 PM
					</div>
					

				<div class="Article_display" id="Art1">1</div>
				<div class="Article_display" id="Art2">2</div>
				

<br />






                <div class="slide" id="<?php echo "slide"."$row[Catalog_Order]"; ?>" <?php if($row['Catalog_Order']== 0) echo "style=\"display: block;\"";?> > <img src=" <?php echo "$row[Link]"; ?>" height="430" width="680" /> </div>
                <div class="Tag_display" id="<?php echo "Tag"."$row[Catalog_Order]"; ?>" <?php if($row['Catalog_Order']== 0) echo "style=\"display: block;\"";?> > <p> <?php echo "$row[Tag]"; ?></p> </div>
                <div class='Article_display' id="<?php echo "Art"."$row[Catalog_Order]"; ?>" <?php if($row['Catalog_Order']== 0) echo "style=\"display: block;\"";?> >
                    <div class="Headline_display" style="text-align: center;" id="<?php echo "headline"."$row[Catalog_Order]"; ?>" <?php if($row['Catalog_Order']== 0) echo "style=\"display: block;\"";?> > 
                        <p><h3> <?php echo "$row[Headline]"; ?> </h3></p>
                    </div>
                    <div class="Author_display" style="text-align: center;" id="<?php echo "Author"."$row[Catalog_Order]"; ?>" > 
                        <p>&nbsp&nbsp&nbsp&nbsp发布者：  <?php echo "$row[Author]";   ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp发表于&nbsp&nbsp<?php echo "$row[Datetime]"; ?></p>
                    </div>
                    <div class="Article_spot" style="text-align: center;" id="<?php echo "Article"."$row[Catalog_Order]"; ?>" > 
                        <p> <?php echo "$row[Content]"; ?></p> 
                    </div>
                </div>
                



		<div id="popular_box_headline">
			<p style="text-align: center">编辑推荐</p>
		</div>
		<div class="popular_box"> 
			<div class="popular_picbox">
			    <div class="Tag_display_pop" id="Tag_p1"><p>P妈太傻</p></div>
				<img src="http://www.out.com/sites/out.com/files/styles/large_teaser_custom_user_desktop_1x/public/bdm-mbjordan-hemsworth.jpg" align="middle" />
			</div>
			<div class="Headline_display_pop"><p>An American (and Brit) Conquer Paris (and Broadway)</p></div>
			<div class="Bot_display_pop">
				<div class="Time_display_pop">
					<p valign="top">2000-01-01 00:00:00</p>
				</div>
				<div class="Share_display_pop">
					<div id="QQ_BOX">
					<!-- QQ -->
					<script type="text/javascript">
					(function(){
					var p = {
					url:location.href,
					showcount:'0',/*是否显示分享总数,显示：'1'，不显示：'0' */
					desc:'',/*默认分享理由(可选)*/
					summary:'',/*分享摘要(可选)*/
					title:'',/*分享标题(可选)*/
					site:'',/*分享来源 如：腾讯网(可选)*/
					pics:'', /*分享图片的路径(可选)*/
					style:'203',
					width:22,
					height:22
					};
					var s = [];
					for(var i in p){
					s.push(i + '=' + encodeURIComponent(p[i]||''));
					}
					document.write(['<a version="1.0" class="qzOpenerDiv" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?',s.join('&'),'" target="_blank">分享</a>'].join(''));
					})();
					</script>
					<script src="http://qzonestyle.gtimg.cn/qzone/app/qzlike/qzopensl.js#jsdate=20111201" charset="utf-8"></script>
					</div>
					<div id="QQ_BOX">
					<!-- RENREN -->
					<script type="text/javascript" src="http://widget.renren.com/js/rrshare.js"></script>
					<a name="xn_share" onclick="shareClick()" type="icon" href="javascript:;"></a>
					<script type="text/javascript">
					function shareClick() {
		  				var rrShareParam = {
						resourceUrl : '',	//分享的资源Url
						srcUrl : '',	//分享的资源来源Url,默认为header中的Referer,如果分享失败可以调整此值为resourceUrl试试
						pic : '',		//分享的主题图片Url
						title : '',		//分享的标题
						description : ''	//分享的详细描述
					};
					rrShareOnclick(rrShareParam);
					}
					</script>
					</div>
					<div id="QQ_BOX">
					<a href="javascript:void(function(){var d=document,e=encodeURIComponent,s1=window.getSelection,s2=d.getSelection,s3=d.selection,s=s1?s1():s2?s2():s3?s3.createRange().text:'',r='http://www.douban.com/recommend/?url='+e(d.location.href)+'&title='+e(d.title)+'&sel='+e(s)+'&v=1',x=function(){if(!window.open(r,'douban','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330'))location.href=r+'&r=1'};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})()"><img src="http://img2.douban.com/pics/fw2douban_s.png" alt="推荐到豆瓣" /></a>
					</div>
				</div>
			</div>
		</div>
		<div class="popular_box">
			<div class="popular_picbox">
			    <div class="Tag_display_pop" id="Tag_p2"><p>色情主播</p></div>
				<img src="https://loveisnotaboutgender.files.wordpress.com/2012/09/gay-pride-legalize-why-is-loving-someone-illegal-facebook-timeline-cover-banner-photo-for-fb-profile.jpg" align="bottom" />				
 
			</div>
		</div>
		<div class="popular_box">
		     <div class="popular_picbox">
		         <div class="Tag_display_pop" id="Tag_p3"><p>H片勿入</p></div>
		         <img src="http://www.out.com/sites/out.com/files/bo8a8771.jpg" />
		     </div>    
		</div>
		<div class="popular_box"></div>
		
<wb:share-button addition="number" url="http://www.qafone.co/" type="icon" ralateUid="1768888052"></wb:share-button>


			<div class="latest_picbox">
			    <div class="Tag_display_latest" id="Tag_p1"><p>P妈太傻</p></div>
				<img src="http://www.out.com/sites/out.com/files/styles/large_teaser_custom_user_desktop_1x/public/bdm-mbjordan-hemsworth.jpg" align="middle" />
			</div>
			<div class="Headline_display_latest"><p>An American (and Brit) Conquer Paris (and Broadway)</p></div>
			<div class="Bot_display_latest">
				<div class="Time_display_latest">
					<p valign="top">2000-01-01 00:00:00</p>
				</div>
				<div class="Share_display_pop">
				</div>
				
				
				
							<div class="latest_picbox">
			    <div class="Tag_display_latest" id="Tag_p1"><p>sfdgsdfg</p></div>
				<img src="http://www.out.com/sites/out.com/files/styles/large_teaser_custom_user_desktop_1x/public/bdm-mbjordan-hemsworth.jpg" align="middle" />
			</div>
			<div class="Headline_display_latest"><p>An American (and Brit) Conquer Paris (and Broadway)</p></div>
			<div class="Bot_display_latest">
				<div class="Time_display_latest">
					<p valign="top">2000-01-01 00:00:00</p>
				</div>
				<div class="Share_display_pop">
				</div>
			</div>
			</div>
			
            
                                <script>
                    $(document).ready(function(){
                        var decay =                        
                        $("<?php echo "#slide"."$Catalog_Order"; ?>").fadeIn(decay);
                    });
                    </script>
                    

                    <div class="Fllow_art" style="text-align: center;" id="<?php echo "Follow"."$row[Catalog_Order]"; ?>" > 
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_native_toolbox"></div>
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553674d825ba5cfc" async="async"></script>


                    </div>
                    
















		<div id="menu_portrait">
			<img src="https://41.media.tumblr.com/67ffc8af84a30c01a4cd69816422c2b6/tumblr_nnkxa26X0e1u4j7b5o2_250.jpg" />
		</div>
		<div id="M_Topbar">
			
		</div>
		<div id="M_left_bar">
			<div id="left_menu_bar">
				<div id="menu_namebox">
					<p style="text-align: center">阳仔</p>
				</div>
				<div class="left_menu_part">
					<div class="left_sub_part" style="text-align: center">
						<div class="left_sub_part_P" id="a321">111111111</div>
					</div>
					<div class="left_mainer" id="submenu123">asdfasf</div>					
					
					<div class="left_sub_part" style="text-align: center">
						<div class="left_sub_part_P">2</div>
					</div>
					<div class="left_sub_part" style="text-align: center">
						<div class="left_sub_part_P"></div>
					</div>
					<div class="left_sub_part" style="text-align: center">4</div>
					<div class="left_sub_part" style="text-align: center">5</div>
				</div>
			</div>
		</div>