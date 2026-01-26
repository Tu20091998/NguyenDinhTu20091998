<?php

namespace app;

class Home
{
    public static function index(): string
    {
        return '
        <div style="
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:linear-gradient(135deg,#74ebd5,#9face6);
            font-family:Segoe UI, sans-serif;
        ">
            <div style="
                background:#fff;
                padding:40px 60px;
                border-radius:16px;
                box-shadow:0 15px 40px rgba(0,0,0,.15);
                text-align:center;
            ">
                <h1 style="margin-bottom:10px;">🏠 Home Page</h1>
                <p style="color:#666;">Welcome to your MVC mini framework</p>
            </div>
        </div>
        ';
    }
}
