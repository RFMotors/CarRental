<section class="search-filter">
    <h2>Find Your Car</h2>
    <form method="GET" action="/index.php" class="search-form">
        <input type="text" name="query" placeholder="Search by car..." value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>">

        <label><input type="checkbox" name="sort_price" <?= isset($_GET['sort_price']) ? 'checked' : '' ?>> Sort by Lowest Price</label>

        <label><input type="checkbox" name="only_available" <?= isset($_GET['only_available']) ? 'checked' : '' ?>> Show Only Available</label>

        <button type="submit" class="btn-search">Search</button>
    </form>
</section>