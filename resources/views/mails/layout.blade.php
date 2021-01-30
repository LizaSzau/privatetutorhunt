<!DOCTYPE html>
<html>
	<head>
		<title>
			@lang('index.app-name') - @yield('title')
		</title>
	</head>
	<body style="font-size: 16px;">
		<div style="width: 100%; color: #1e1e1e; font-family: verdana;">
			<div style="width: 100%; background: #c5c4c4; margin-bottom: 20px; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px; ">
				<div style="padding: 20px 10px 10px 10px; max-width: 600px; margin: 0 auto; color: #29295e; font-size: 32px; font-weight: bold;">
					<span>Private</span><span style="color: #ffffff;">Hunt</span><span>Hunt</span><span style="color: #1e1e1e; font-size: 20px;">.com</span>
				</div>
				<div style="padding: 0 10px 20px 10px; max-width: 600px; margin: 0 auto; color: #249ad1; font-size: 28px; font-weight: bold;">
					@yield('subject')
				</div>
			</div>

			<div style="max-width: 600px; margin: 0 auto; padding: 10px;">
				@yield('message')
				
				<p style="color: #1e1e1e;">@lang('mail.regards')
				<br style="color: #29295e;">@lang('mail.sign')</p>
			</div>
			
			<div style="width: 100%; background: #249ad1; margin-bottom: 0; margin-top: 20px;  border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px; ">
				<div style="padding: 20px 10px; max-width: 600px; margin: 0 auto;">
					<span style="color: #ffffff; font-size: 22px; font-weight: bold;">@lang('index.slogen')</span>
					<br><span><a href="https://@lang('index.site-name')" style="font-size: 18px; color: #29295e; text-decoration: none;">www.@lang('index.site-name')</a></span>
				</div>
			</div>
		</div>
	</body>
</html>