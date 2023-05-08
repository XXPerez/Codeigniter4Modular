<section>
    <h1>{moduleName}::index() => {moduleName}/Views/{moduleName}.php</h1>
</section>

<section>
    <h1>{moduleName}Library::greet() => <?php echo $LibraryResponse ?></h1>
</section>

<section>
    <h1>{moduleName}Model::generateFakeData() => Count element <?php echo count($ModelResponse) ?></h1>
    <table>
        <thead>
            <tr>
                <th>first</th>
                <th>email</th>
                <th>phone</th>
                <th>avatar</th>
                <th>login</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ModelResponse as $key => $value) : ?>
                <tr>
                    <th><?php echo $value["first"] ?></th>
                    <th><?php echo $value["email"] ?></th>
                    <th><?php echo $value["phone"] ?></th>
                    <th><?php echo $value["avatar"] ?></th>
                    <th><?php echo $value["login"] ?></th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<style>
    table,
    th,
    td {
        border: 1px solid black;
    }

    table {
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
    }
</style>
</section>