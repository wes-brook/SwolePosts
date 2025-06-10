<!-- User not logged in - split layout with video -->
<div class="container-left">
    <div class="video-container">
        <video autoplay muted loop>
            <source src="<?php echo asset('assets/LoginPageVideo.mp4'); ?>" type="video/mp4">
            If you're seeing this, your browser could not handle Ronnie Yeah Buddy Coleman.
        </video>
    </div>
</div>
<div class="container-right">
    <div class="spline-background">
        <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.96/build/spline-viewer.js"></script>
        <spline-viewer url="https://prod.spline.design/H5LLDspru1NGKy9d/scene.splinecode"></spline-viewer>
    </div>

    <div class="content-overlay">
        <h1>GymThreads</h1>
        <p>Where your journey fuels others and theirs fuels you.<br>Welcome to the future of fitness.</p>
        <div class="auth-container">
            <div class="auth-forms">
                <div class="auth-form">
                    <h2>Login</h2>
                    <form action="/login" method="POST">
                        @csrf
                        <input type="text" name="loginname" placeholder="Username or email">
                        <input type="password" name="loginpassword" placeholder="Password">
                        <div class="remember-me">
                            <p>Remember login details?</p>
                            <input type="checkbox" name="remember" id="remember">
                        </div>
                        <button>Log in</button>
                    </form>
                </div>
                <div class="auth-form">
                    <h2>Register</h2>
                    <form action="/register" method="POST">
                        @csrf
                        <input type="text" name="name" placeholder="Username">
                        <input type="text" name="email" placeholder="Email">
                        <input type="password" name="password" placeholder="Password">
                        <button>Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
