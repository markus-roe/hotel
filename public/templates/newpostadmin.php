<h1 class="text-center">Add New Article</h1>

<div class="ipsum-form">
    <form action="/post/new" method="POST">
        <div class="ipsum-fieldset">
            <div class="ipsum-input-wrapper">
                <div class="ipsum-input-container labelOnTop horizontalLine">
                    <label for="title">Title</label>
                    <input class="ipsum-input text" type="text" id="title" name="articleTitle"
                        placeholder="Title" />
                </div>
                <div class="ipsum-input-container labelOnTop horizontalLine">
                    <label for="content">Content</label>
                    <textarea class="ipsum-input textarea" id="content" name="articleContent"
                        placeholder="Content..." rows="20"></textarea>
                </div>
                <div class="ipsum-input-container labelOnTop horizontalLine">
                    <label for="articleImage">Upload Image</label>
                    <input type="file" name="articleImage" id="articleImage" placeholder="Upload Image">
                </div>

            </div>
        </div>
        <div class="center">
            <button class="ipsum-button affirm" type="submit">Submit</button>
        </div>

    </form>
</div>