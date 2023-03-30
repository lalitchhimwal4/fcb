<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Email Template</title>
    <style type="text/css">
    body {
        margin: 0;
    }
    .cstm-sec, .email-body {
        width: 100%;
        max-width: 620px;
        margin: 0 auto;
        border: 1px solid #f0efeb;
    }
    .email-header figure {
        height: 120px;
        width: 190px;
        margin: 10px auto;
    }
    .email-header figure img {
        height: 100%;
        width: 100%;
        object-fit: scale-down;
    }
    .email-header {
        border: 1px solid #f0efeb;

        background-color: #f0efeb;
    }
    .email-content h1 {
        font-size: 20px;
        line-height: 18px;
        color: #e63b2b;
        font-weight: 600;
        padding: 15px;
        border-bottom: 1px solid #f0efeb;
        text-align: center;
        margin: 0;
    }
    .cstm-sec p {
        padding: 0px 15px 5px;
    }
    .main-fotter p {
        padding: 0px 15px 5px;
        font-size: 15px;
        text-align: center;
    }
    .main-fotter {
        border: 1px solid #f0efeb;
        border-collapse: collapse;
        width: 100%;
        max-width: 620px;
        margin: 0 auto;
        background-color: #f0efeb;
    }
    .heading {
        background-color: #000;
        padding: 15px;
    }
    .heading h5 {
        font-size: 16px;
        line-height: 25px;
        color: #fff;
        font-weight: 600;
        /*text-align: center;*/
        margin: 0;
    }
    .cstm-sec.email-name p {
        margin: 10px 0;
    }
    .cstm-sec.email-name p b {
        min-width: 110px;
        display: inline-block;
    }

    .email-body {
        padding-left: 1.5em;
        border: none;
    }
    </style>
</head>

<body>
    <!-- header -->
    <header class="email-header cstm-sec">
        <figure>
             <img src="{{asset('/storage/'.Get_Meta_Tag_Value('General_Settings','Header_Logo'))}}" alt="logo" title="logo" width="200px" height="200px" style="display:block;" />
        </figure>
    </header>
    <!-- header-end -->