<nav>
    <a href="<?=site_url('/');?>">Home</a>
    <a href="<?=site_url('/artikel/home');?>">Artikel</a>
    <a href="<?=site_url('/artikel/admin');?>">Tambah Artikel</a>
    <a href="<?=site_url('/page/about');?>">About</a>
    <?php if (!isset($_SESSION['isLogin'])): ?>
    <a href="<?=site_url('/user/login');?>">Login</a>
    <?php else: ?>
    <a href="<?=site_url('/user/logout');?>">Logout</a>
    <?php endif; ?>
</nav>
