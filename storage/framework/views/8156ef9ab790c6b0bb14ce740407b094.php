<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="theme-color" content="#142b55">
    <title><?php echo $__env->yieldContent('title', 'CampusNotes'); ?> · CampusNotes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--cn-navy:#142b55;--cn-blue:#2563eb;--cn-sky:#38bdf8;--cn-ink:#172033;--cn-muted:#64748b;--cn-line:#e2e8f0;--cn-bg:#f5f8fd;--cn-white:#fff}
        *{box-sizing:border-box}
        html{min-height:100%;background:var(--cn-bg)}
        body{margin:0;min-height:100vh;color:var(--cn-ink);font:14px Inter,'Hind Siliguri',sans-serif;background:var(--cn-bg)}
        a{color:var(--cn-blue);text-decoration:none}
        button,input,select{font:inherit}
        .auth-page{min-height:100vh;display:grid;grid-template-columns:minmax(340px,.9fr) minmax(0,1.1fr)}
        .auth-visual{position:relative;isolation:isolate;overflow:hidden;min-height:100vh;padding:38px clamp(28px,5vw,76px);display:flex;flex-direction:column;justify-content:space-between;color:#fff;background:linear-gradient(145deg,#102448 0%,#142b55 48%,#2563eb 115%)}
        .auth-visual:before,.auth-visual:after{position:absolute;z-index:-1;content:"";border:1px solid #ffffff20;border-radius:50%;width:580px;height:580px;right:-280px;top:12%}
        .auth-visual:after{width:410px;height:410px;right:-195px;top:24%;border-color:#ffffff27}
        .auth-brand{display:inline-flex;align-items:center;gap:12px;color:#fff;font-size:20px;font-weight:800;letter-spacing:-.5px}
        .auth-logo{width:43px;height:43px;display:grid;place-items:center;border-radius:13px;background:#fff;color:var(--cn-navy);font-size:21px;font-weight:800;box-shadow:0 8px 24px #071a3d4a}
        .auth-visual-copy{max-width:510px;margin:54px 0;position:relative}
        .auth-chip{display:inline-flex;align-items:center;gap:8px;border:1px solid #ffffff35;border-radius:99px;padding:8px 12px;color:#dbeafe;font-size:10px;font-weight:800;letter-spacing:1.3px;text-transform:uppercase;background:#ffffff0d}
        .auth-visual h1{font-size:clamp(34px,4vw,54px);line-height:1.12;letter-spacing:-2px;margin:22px 0 16px;color:#fff}
        .auth-visual-copy>p{max-width:440px;color:#dbeafe;font-size:15px;line-height:1.85;margin:0}
        .auth-feature-list{display:grid;gap:14px;margin-top:34px}
        .auth-feature{display:flex;gap:13px;align-items:center;color:#eff6ff}
        .auth-feature-icon{width:39px;height:39px;flex:0 0 39px;display:grid;place-items:center;border-radius:12px;background:#ffffff17;border:1px solid #ffffff20;font-size:17px}
        .auth-feature strong,.auth-feature small{display:block}
        .auth-feature strong{font-size:12px}
        .auth-feature small{font-size:11px;color:#bfdbfe;margin-top:4px}
        .auth-visual-foot{font-size:11px;color:#bfdbfe}
        .auth-main{min-width:0;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:30px clamp(20px,5vw,76px);position:relative}
        .auth-top-link{position:absolute;top:28px;right:clamp(20px,5vw,76px);font-size:12px;font-weight:700;color:#52627b}
        .auth-top-link:hover{color:var(--cn-blue)}
        .auth-form-wrap{width:100%;max-width:470px;margin:48px auto 30px}
        .auth-form-wrap.auth-form-wide{max-width:700px}
        .auth-kicker{display:inline-flex;align-items:center;gap:8px;color:var(--cn-blue);font-size:10px;font-weight:800;letter-spacing:1.4px;text-transform:uppercase}
        .auth-kicker:before{content:"";width:22px;height:2px;background:var(--cn-sky);border-radius:5px}
        .auth-heading{font-size:clamp(27px,3vw,35px);line-height:1.18;letter-spacing:-1.2px;color:var(--cn-navy);margin:12px 0 9px}
        .auth-subtitle{font-size:13px;line-height:1.75;color:var(--cn-muted);margin:0 0 25px;max-width:570px}
        .auth-form{width:100%}
        .auth-grid{display:grid;grid-template-columns:1fr 1fr;gap:0 16px}
        .auth-field{min-width:0;margin:0 0 16px}
        .auth-field.full{grid-column:1/-1}
        .auth-field label{display:block;color:#253653;font-size:11px;font-weight:700;margin:0 0 7px}
        .auth-control{width:100%;height:47px;border:1px solid #dbe3ef;border-radius:10px;background:#fff;color:var(--cn-ink);padding:0 13px;outline:none;transition:border-color .18s,box-shadow .18s;font-size:12px}
        .auth-control:focus{border-color:var(--cn-blue);box-shadow:0 0 0 4px #2563eb16}
        .auth-control::placeholder{color:#9aa8bd}
        select.auth-control{appearance:auto}
        .auth-help{font-size:10px;color:#8491a5;margin-top:6px;line-height:1.5}
        .auth-error{padding:12px 14px;margin:0 0 18px;background:#fff1f2;border:1px solid #fecdd3;color:#be123c;border-radius:10px;font-size:11px;line-height:1.7}
        .auth-error ul{margin:0;padding-left:17px}
        .auth-success{padding:12px 14px;margin:0 0 18px;background:#eff6ff;border:1px solid #bfdbfe;color:#1e40af;border-radius:10px;font-size:11px;line-height:1.65}
        .auth-row{display:flex;align-items:center;justify-content:space-between;gap:12px;margin:3px 0 20px;font-size:11px;color:var(--cn-muted)}
        .auth-check{display:inline-flex;align-items:center;gap:8px;cursor:pointer}
        .auth-check input{width:15px;height:15px;margin:0;accent-color:var(--cn-blue)}
        .auth-submit{width:100%;min-height:49px;border:0;border-radius:10px;background:linear-gradient(100deg,var(--cn-navy),var(--cn-blue));color:#fff;font-size:12px;font-weight:800;letter-spacing:.2px;cursor:pointer;box-shadow:0 8px 18px #2563eb2b;transition:transform .18s,box-shadow .18s}
        .auth-submit:hover{transform:translateY(-1px);box-shadow:0 11px 22px #2563eb38}
        .auth-switch{text-align:center;color:var(--cn-muted);font-size:11px;margin:20px 0 0}
        .auth-switch a{font-weight:800}
        .auth-note{display:flex;align-items:flex-start;gap:9px;padding:12px 13px;margin:1px 0 17px;border:1px solid #bfdbfe;border-radius:10px;background:#eff6ff;color:#1e40af;font-size:10px;line-height:1.65}
        .auth-note strong{color:#1e3a8a}
        .auth-divider{height:1px;background:var(--cn-line);margin:20px 0}
        .auth-legal{text-align:center;color:#94a3b8;font-size:9px;line-height:1.6;margin-top:20px}
        @media(max-width:900px){.auth-page{grid-template-columns: minmax(260px,.72fr) minmax(0,1.28fr)}.auth-visual{padding:30px 25px}.auth-main{padding:28px 25px}.auth-visual h1{font-size:36px}}
        @media(max-width:700px){.auth-page{display:block}.auth-visual{min-height:auto;padding:18px 22px}.auth-visual-copy,.auth-visual-foot{display:none}.auth-visual:before,.auth-visual:after{width:220px;height:220px;right:-115px;top:-100px}.auth-logo{width:37px;height:37px}.auth-brand{font-size:17px}.auth-main{min-height:calc(100vh - 72px);padding:20px 20px 35px}.auth-top-link{top:17px;right:20px;font-size:10px}.auth-form-wrap{margin:42px auto 10px}.auth-form-wrap.auth-form-wide{max-width:520px}.auth-heading{font-size:28px}}
        @media(max-width:480px){.auth-grid{grid-template-columns:1fr}.auth-field.full{grid-column:auto}.auth-row{align-items:flex-start}.auth-visual{padding:14px 18px}.auth-main{padding-left:18px;padding-right:18px}.auth-control{height:46px}}
    </style>
    <?php echo $__env->yieldPushContent('auth_styles'); ?>
</head>
<body>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldPushContent('auth_scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Campus-Notes\resources\views/auth/layouts/campus.blade.php ENDPATH**/ ?>