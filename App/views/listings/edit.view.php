<?php loadpartial('head') ?>
<?php loadpartial('Nav') ?>
<?php loadpartial('topBanner') ?>


<section class="flex justify-center items-center mt-20">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
        <h2 class="text-4xl text-center font-bold mb-4">Edit Job Listing</h2>
        <?php loadPartial('errors', ['errors' => $errors ?? []]) ?>
        <form method="POST" action="/listing/<?= $listings['id'] ?>">
            <input name="_method" type="hidden" value="PUT" />
            <h2 class=" text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>
            <div class="mb-4">
                <input
                    type="text"
                    name="title"
                    placeholder="Job Title"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    value="<?= htmlspecialchars($listings['title']) ?? " " ?>" />
            </div>
            <div class="mb-4">
                <textarea
                    name="description"
                    placeholder="Job Description"
                    class="w-full px-4 py-2 border rounded focus:outline-none"><?= $listings['Description'] ?? "" ?></textarea>
            </div>
            <div class="mb-4">
                <input
                    type="text"
                    name="salary"
                    placeholder="Annual Salary"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    value="<?= $listings['salary'] ?? " " ?>" />
            </div>
            <div class="mb-4">
                <input
                    type="text"
                    name="requierments"
                    placeholder="Requierments"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    value="<?= $listings['requierments'] ?? "" ?>" />
            </div>
            <div class="mb-4">
                <input
                    type="text"
                    name="benifits"
                    placeholder="Benifits"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    value="<?= $listings['benifits'] ?? "" ?>" />
            </div>
            <div class="mb-4">
                <input
                    type="text"
                    name="tags"
                    placeholder="Tags"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    value="<?= $listings['tags'] ?? "" ?>" />
            </div>
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info & Location
            </h2>
            <div class="mb-4">
                <input
                    type="text"
                    name="company"
                    placeholder="Company Name"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    value="<?= $listings['company'] ?? "" ?>" />
            </div>
            <div class="mb-4">
                <input
                    type="text"
                    name="city"
                    placeholder="City"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    value="<?= $listings['city'] ?? "" ?>" />
            </div>
            <div class="mb-4">
                <input
                    type="text"
                    name="country"
                    placeholder="Country"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    value="<?= $listings['country'] ?? "" ?>" />
            </div>
            <div class="mb-4">
                <input
                    type="text"
                    name="phone"
                    placeholder="Phone"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    value="<?= $listings['phone'] ?? " " ?>" />
            </div>
            <div class="mb-4">
                <input
                    type="email"
                    name="email"
                    placeholder="Email Address For Applications"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    value="<?= $listings['email'] ?? "" ?>" />
            </div>
            <button
                class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
                Save
            </button>
            <a
                href="/listing/<?= $listings['id'] ?>"
                class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
                Cancel
            </a>
        </form>
    </div>
</section>

<?php loadpartial('bottomBanner') ?>

</body>

</html>