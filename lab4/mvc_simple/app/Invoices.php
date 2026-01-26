<?php

namespace app;

class Invoices
{
    public static function index(): string
    {
        return '
        <div style="
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:linear-gradient(135deg,#fbc2eb,#a6c1ee);
            font-family:Segoe UI, sans-serif;
        ">
            <div style="
                background:#fff;
                padding:40px 60px;
                border-radius:16px;
                box-shadow:0 15px 40px rgba(0,0,0,.15);
                text-align:center;
            ">
                <h1>📄 Invoices</h1>
                <p style="color:#666;">Danh sách hóa đơn</p>
            </div>
        </div>
        ';
    }

    public static function create(): string
    {
        return '
        <div style="
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:linear-gradient(135deg,#a1c4fd,#c2e9fb);
            font-family:Segoe UI, sans-serif;
        ">
            <div style="
                background:#fff;
                padding:40px 60px;
                border-radius:16px;
                box-shadow:0 15px 40px rgba(0,0,0,.15);
                text-align:center;
            ">
                <h1>➕ Create Invoice</h1>
                <p style="color:#666;">Tạo hóa đơn mới</p>
            </div>
        </div>
        ';
    }
}
