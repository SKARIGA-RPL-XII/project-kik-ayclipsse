<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Kit</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background:#f4f6f9;
    display:flex;
}

.sidebar{
    width:240px;
    height:100vh;
    background:#0d3b66;
    color:white;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    position:fixed;
    left:0;
    top:0;
}

.sidebar-top{
    padding:25px 20px;
}

.logo{
    font-size:18px;
    font-weight:600;
    margin-bottom:30px;
    display:flex;
    align-items:center;
}

.logo::before{
    content:"";
    width:12px;
    height:12px;
    background:#4f83ff;
    border-radius:50%;
    margin-right:10px;
}

.menu{
    list-style:none;
}

.menu li{
    margin-bottom:12px;
}

.menu a{
    text-decoration:none;
    color:#cdd9e5;
    display:flex;
    align-items:center;
    padding:10px 12px;
    border-radius:6px;
    transition:0.3s;
    font-size:14px;
}

.menu a:hover,
.menu a.active{
    background:#123f70;
    color:white;
}

.menu a i{
    margin-right:10px;
}

.logout{
    padding:20px;
    border-top:1px solid rgba(255,255,255,0.2);
}

.logout a{
    text-decoration:none;
    color:#cdd9e5;
    font-size:14px;
}

.main{
    margin-left:240px;
    width:100%;
    padding:40px 60px;
}

.header h1{
    font-size:28px;
    font-weight:600;
    color:#1d3557;
}

.header h1 span{
    color:#f4b400;
}

.header p{
    margin-top:5px;
    color:#6c757d;
    font-size:14px;
}

.empty-state{
    margin-top:60px;
    text-align:center;
}

.empty-state img{
    width:280px;
    margin-bottom:30px;
}

.empty-state h2{
    font-size:20px;
    color:#1d3557;
    margin-bottom:8px;
}

.empty-state p{
    font-size:14px;
    color:#6c757d;
    margin-bottom:25px;
}

.empty-state button{
    background:#0d3b66;
    color:white;
    border:none;
    padding:12px 40px;
    border-radius:6px;
    cursor:pointer;
    font-size:14px;
    transition:0.3s;
}

.empty-state button:hover{
    background:#092c4d;
}

</style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-top">
        <div class="logo">Dashboard Kit</div>

        <ul class="menu">
            <li><a href="#" class="active">Dashboard</a></li>
            <li><a href="#">Profil Usaha</a></li>
            <li><a href="#">Produk Usaha</a></li>
        </ul>
    </div>

    <div class="logout">
        <a href="#">Log Out</a>
    </div>
</div>


<div class="main">
    <div class="header">
        <h1>Selamat Datang <span>Raysha!</span></h1>
        <p>Kelola pendaftaran PIRT dan produk usahamu di sini.</p>
    </div>

    <div class="empty-state">
        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486820.png" alt="No Data">

        <h2>Tidak ada data</h2>
        <p>Klik <strong>Pendaftaran PIRT</strong> untuk menambah data.</p>

        <button>Pendaftaran PIRT</button>
    </div>
</div>

</body>
</html>
