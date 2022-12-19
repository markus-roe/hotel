<h1 class="text-center">Add New Article</h1>

<div class="ipsum-form">
    <form action="{{post-link}}" method="POST" enctype="multipart/form-data">
        <div class="ipsum-fieldset">
            <div class="ipsum-input-wrapper">
                <div class="ipsum-input-container labelOnTop horizontalLine">
                    <label for="title">Title</label>
                    <input class="ipsum-input text" type="text" id="title" name="articleTitle"
                        placeholder="Title" />
                </div>
                <div class="ipsum-input-container labelOnTop horizontalLine">
                    <label for="content">Content</label>
                    <textarea class="ipsum-input textarea text" id="content" name="articleContent"
                        placeholder="Content...
# Große Überschrift
## Mittelgroße Überschrift
### Kleine Überschrift" rows="20"></textarea>
                </div>
                <div class="ipsum-input-container labelOnTop horizontalLine">
                    <label for="articleImage">Upload Image</label>
                    <input type="file" accept="image/png, image/gif, image/jpeg" name="articleImage" id="articleImage" placeholder="Upload Image">
                </div>

            </div>
        </div>
        <div class="center">
            <button class="ipsum-button affirm" type="submit">Submit</button>
        </div>
    </form>
    <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank">Markdown Cheat-Sheet</a>

</div>