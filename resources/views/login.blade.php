<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        :root {
            /* Atlassian Design Colors */
            --background-color: #ffffff;
            --text-color: #172B4D;
            --text-color-secondary: #6B778C;
            --input-border-color: #DFE1E6;
            --input-focus-border-color: #4C9AFF;
            --button-bg-color: #6554C0;
            --button-hover-bg-color: #8777D9;
            --button-text-color: #ffffff;
            --error-color: #DE350B;

            /* Font */
            --font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: var(--background-color);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 24px;
            box-sizing: border-box;
        }

        .login-container h1 {
            font-size: 24px;
            margin-bottom: 16px;
            color: var(--text-color);
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-color-secondary);
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            color: var(--text-color);
            border: 1px solid var(--input-border-color);
            border-radius: 4px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .login-container input:focus {
            border-color: var(--input-focus-border-color);
            outline: none;
        }

        .login-container .error-message {
            color: var(--error-color);
            font-size: 12px;
            margin-top: -12px;
            margin-bottom: 16px;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            font-weight: bold;
            color: var(--button-text-color);
            background-color: var(--button-bg-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .login-container button:hover {
            background-color: var(--button-hover-bg-color);
        }

        .login-container .footer {
            text-align: center;
            margin-top: 16px;
            font-size: 14px;
            color: var(--text-color-secondary);
        }

        .login-container .footer a {
            color: var(--button-bg-color);
            text-decoration: none;
        }

        .login-container .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
    <h2>Login</h2>

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
    <form action="{{ url('login') }}" method="POST">
        @csrf
        <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Log In</button>

            <div class="footer">
                <p>Don't have an account? <a href="dashboard">Sign up</a></p>
            </div>
    </form>
    </div>

    
</body>
</html>
