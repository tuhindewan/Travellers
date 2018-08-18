@include('frontend._partials.header')

<style type="text/css">
	hr{margin:5px 0;}
	.tab-content {width:100%; overflow: hidden;}
	
    .nav-tabs { background: #e7e9ef;}
</style> 
@include('frontend._partials.nav')

<section>
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-2" id="company-info">
				<div class="company_basic_info">
					<div class="company_logo">
					<img src="{{asset('public/frontend/img/logo.png')}}" alt="">
					</div>
					<div class="company_name">
						<h3>Tour and Travels Companry</h3>
						<p>@company name</p>
					</div>
					<hr>
					<div class="company_list">
						<!-- tabs -->
						<div class="tabbable tabs-left">
							<ul class="nav nav-tabs" role="tablist" style="width: 100%;">
								<li role="presentation" class="active"><a href="#package" role="tab" data-toggle="tab">Package</a></li>
								<li role="presentation"><a href="#about" role="tab" data-toggle="tab">About</a></li>
								
							</ul>

							
						</div>
					</div>
				</div>	
			</div>
			<div class="col-md-7" id="company_contant">
				
				<div class="company_service_slide">
					<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:900px;height:380px;overflow:hidden;visibility:hidden;">
			            <!-- Loading Screen -->
			            <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
			                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="https://www.jssor.com/theme/svg/loading/static-svg/spin.svg" />
			            </div>
			            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:900px;height:380px;overflow:hidden;">
			                
			                
			                <div>
			                    <img data-u="image" src="{{asset('public/frontend/images/items2/item1.jpg')}}" />
			                    <div data-u="caption" data-t="2" style="position:absolute;top:30px;left:-380px;width:350px;height:30px;z-index:0;background-color:rgba(255,188,5,0.8);font-size:25px;color:#ffffff;line-height:30px;text-align:center;">finger catchable right to left</div>

			                    <div data-u="caption" data-t="4" style="position:absolute;top:130px;left:60px;width:450px;min-height:30px;z-index:0;background-color:rgba(255,188,5,0.8);font-size:15px;color:#ffffff;padding:0 10px;line-height:30px;text-align:left;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised</div>
			                </div>
			                <div>
			                    <img data-u="image" src="{{asset('public/frontend/images/items2/item2.jpg')}}" />
			                    <div data-u="caption" data-t="3" style="position:absolute;top:30px;left:30px;width:350px;height:30px;z-index:0;background-color:rgba(255,188,5,0.8);font-size:20px;color:#ffffff;line-height:30px;text-align:center;">responsive, scale smoothly</div>
			                </div>
			                <div>
			                    <img data-u="image" src="{{asset('public/frontend/images/items2/item3.jpg')}}" />
			                    <div data-u="caption" data-t="4" style="position:absolute;top:30px;left:30px;width:350px;height:30px;z-index:0;background-color:rgba(255,188,5,0.8);font-size:20px;color:#ffffff;line-height:30px;text-align:center;">image, text, and custom layers</div>
			                </div>
			                <div>
			                    <img data-u="image" src="{{asset('public/frontend/images/items2/item4.jpg')}}" />
			                    <div data-u="caption" data-t="5" style="position:absolute;top:30px;left:600px;width:350px;height:30px;z-index:0;background-color:rgba(255,188,5,0.8);font-size:20px;color:#ffffff;line-height:30px;text-align:center;">tons of transition type</div>
			                </div>
			                <div>
			                    <img data-u="image" src="{{asset('public/frontend/images/items2/item5.jpg')}}" />
			                    <div data-u="caption" data-t="6" style="position:absolute;top:30px;left:30px;width:350px;height:30px;z-index:0;background-color:rgba(255,188,5,0.8);font-size:20px;color:#ffffff;line-height:30px;text-align:center;">visual slider maker</div>
			                </div>
			                <div data-b="0">
			                    <img data-u="image" src="{{asset('public/frontend/images/items2/item6.jpg')}}" />
			                    <div data-u="caption" data-t="7" style="position:absolute;top:-50px;left:30px;width:350px;height:30px;z-index:0;background-color:rgba(255,188,5,0.8);font-size:20px;color:#ffffff;line-height:30px;text-align:center;">play in and play out</div>
			                </div>
			               
			                
			            </div>
			            <!-- Bullet Navigator -->
			            <div data-u="navigator" class="jssorb052" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
			                <div data-u="prototype" class="i" style="width:16px;height:16px;">
			                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
			                        <circle class="b" cx="8000" cy="8000" r="5800"></circle>
			                    </svg>
			                </div>
			            </div>
			            <!-- Arrow Navigator -->
			            <div data-u="arrowleft" class="jssora053" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
			                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
			                    <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
			                </svg>
			            </div>
			            <div data-u="arrowright" class="jssora053" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
			                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
			                    <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
			                </svg>
			            </div>
			            <div data-interaction="user-commands" class="cmd-box" style="display:none;top:2px;left:auto;bottom:auto;right:2px;width:23px;height:69px;box-sizing:border-box;" data-scale=".2" data-scale-top=".5" data-scale-right=".5">
			                <div data-command="jssor-getslider" class="cmd-btn" title="get this slider"></div>
			                <div data-command="jssor-qrcode" class="cmd-btn" title="QR code"></div>
			                <div data-command="jssor-share" class="cmd-btn" title="share"></div>
			            </div>
			        </div>
				</div>
				
				<div id="content" style="margin:10px 0; width: 100%; overflow: hidden;">
				    <div class="tab-content" style="background: #e7e9ef; border-radius: 10px; padding: 10px;padding-bottom: 0;">
				    	
						<div role="tabpanel" class="tab-pane active" id="package">                
							<div class="panel panel-default">
								<div class="panel-body">
						    		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
									<p>These lists are meant to identify articles which deserve editor attention because they are the most important for an encyclopedia to have, as determined by the community of participating editors. They may also be of interest to readers as an alternative to lists of overview articles. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					  			</div>
							</div>
						</div> 
						<div class="tab-pane" id="about"> 
							<div class="panel panel-default">
								<div class="panel-body">
									<p>because they are the most important for an encyclopedia to have, as determined by the community of participating editors. They may also be of interest to readers as an alternative to lists of overview articles.</p>  
								</div>              
							</div>
						</div>
					</div>
				</div>			
						
			</div>
			<div class="col-md-3 no_padding">
				<div class="company_activity_section">
					<div class="top">
						<div class="panel panel-default">
							<div class="panel-heading">Top 10 Plans</div>
							<div class="panel-body">
							    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
							</div>
						</div>
					</div>

					<div class="top">
						<div class="panel panel-default">
							<div class="panel-heading">Top 10 Suggestions</div>
							<div class="panel-body">
							    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
							</div>
						</div>
					</div>

					<div class="top">
						<div class="panel panel-default">
							<div class="panel-heading">Top 10 Question</div>
							<div class="panel-body">
							    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
							</div>
						</div>
					</div>

						
				</div>
			</div>
		</div>
	</div>
</section>

@include('frontend._partials/footer')