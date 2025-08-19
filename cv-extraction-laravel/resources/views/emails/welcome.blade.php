<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome to {{ $appName }}</title>
	<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<style>
		/* Basic, email-safe styles inlined for consistency */
		body { margin:0; padding:0; background:#F5F5F5; font-family:'Space Grotesk', Arial, sans-serif; color:#191A23; }
		.container { max-width:640px; margin:0 auto; padding:24px 16px; }
		.card { background:#ffffff; border:2px solid #191A23; border-radius:16px; box-shadow:0 6px 0 0 #191A23; overflow:hidden; }
		.header { padding:22px 20px 10px; background:#ffffff; border-bottom:1px solid #eee; text-align:center; }
		.logo { height:100px; }
		.brand-accent { height:6px; background:#B9FF66; border-top:2px solid #191A23; border-bottom:2px solid #191A23; }
		.content { padding:28px 24px; }
		.badge { display:inline-block; padding:6px 12px; background:#B9FF66; color:#191A23; border:2px solid #191A23; border-radius:10px; font-weight:700; font-size:13px; letter-spacing:0.3px; }
		.h1 { font-size:30px; line-height:1.3; margin:16px 0 10px; font-weight:700; }
		.lead { font-size:17px; line-height:1.7; margin:6px 0 18px; color:#30323a; }
		.p { font-size:15px; line-height:1.7; margin:0 0 16px; color:#30323a; }
		.button-wrap { margin:24px 0; text-align:center; }
		.button { display:inline-block; background:#B9FF66; color:#191A23 !important; text-decoration:none; font-weight:700; padding:12px 18px; border:2px solid #191A23; border-radius:10px; box-shadow:0 4px 0 0 #191A23; }
		.button-secondary { display:inline-block; color:#191A23 !important; text-decoration:none; font-weight:700; padding:12px 18px; border:2px solid #191A23; border-radius:10px; background:#fff; }
		.footer { padding:20px; text-align:center; color:#666; font-size:12px; }
		.hr { height:1px; border:none; background:#eee; margin:24px 0; }
		.note { font-size:12px; color:#666; }
		.feature-list { list-style:none; padding:0; margin:0 0 8px 0; }
		.feature-list li { margin:8px 0; padding-left:24px; position:relative; font-size:15px; color:#30323a; }
		.feature-list li:before { content:'\2713'; position:absolute; left:0; top:0; color:#191A23; background:#B9FF66; border:2px solid #191A23; width:18px; height:18px; line-height:14px; text-align:center; border-radius:6px; font-weight:700; font-size:12px; }
	</style>
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="header">
				<img class="logo" src="https://www.smartconnect.work/images/svg/site-logo.png" alt="{{ $appName }}">
			</div>
			<div class="brand-accent"></div>
			<div class="content">
				<!-- Preheader (hidden in most clients) -->
				<div style="display:none;overflow:hidden;line-height:1px;opacity:0;max-height:0;max-width:0;mso-hide:all;">
					Welcome to {{ $appName }} — your account is ready. Jump into your dashboard to get started.
				</div>
				<span class="badge">Welcome to {{ $appName }}</span>
				<h1 class="h1">Hi {{ $user->name }}, welcome aboard!</h1>
				<p class="lead">Your {{ strtolower($user->isRecruiter() ? 'Recruiter' : 'Job Seeker') }} account is ready. Power up your hiring or job search with our modern, AI-driven tools — designed with the same clean look and bold accents you see on our site.</p>

				<ul class="feature-list">
					<li>Upload a CV and instantly extract structured data</li>
					<li>Run AI compatibility analysis against job descriptions</li>
					<li>Build a standout profile to improve your match quality</li>
				</ul>
				<div class="button-wrap">
					<a class="button" href="{{ $targetUrl }}">Go to your dashboard</a>
					@if(!empty($appUrl))
						&nbsp;&nbsp;
						<a class="button-secondary" href="{{ $appUrl }}">Explore features</a>
					@endif
				</div>
				<hr class="hr">
				<p class="p" style="margin-bottom:8px; font-weight:700;">Quick tips</p>
				<p class="p" style="margin:0 0 10px;">Save this link to access your dashboard anytime:</p>
				<p class="note">{{ $targetUrl }}</p>
			</div>
			<div class="footer">
				<p>&copy; {{ date('Y') }} {{ $appName }}. All rights reserved.</p>
				@if(!empty($appUrl))
					<p><a href="{{ $appUrl }}" style="color:#191A23; text-decoration:none;">Visit website</a></p>
				@endif
			</div>
		</div>
	</div>
</body>
</html>


