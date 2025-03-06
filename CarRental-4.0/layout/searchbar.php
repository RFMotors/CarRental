<link rel="stylesheet" href="/css/searchbar.css">
<section class="search-filter">
    <h2>Find Yours</h2>
    <form action="search.php" method="GET" class="search-form">
        <input type="text" name="query" placeholder="Search by car name..." class="input-field">

        <select name="car-type" class="input-field">
            <option value="">All Types</option>
            <option value="SUV">SUV</option>
            <option value="Sedan">Sedan</option>
            <option value="Sports">Sports</option>
            <option value="Electric">Electric</option>
        </select>

        <input type="number" name="min-price" placeholder="Min Price (€)" class="input-field">
        <input type="number" name="max-price" placeholder="Max Price (€)" class="input-field">

        <input type="date" name="pickup-date" required class="input-field">
        <input type="time" name="pickup-time" required class="input-field">
        <input type="date" name="return-date" required class="input-field">
        <input type="time" name="return-time" required class="input-field">

        <button type="submit" class="search-button">Search</button>
    </form>
</section>
