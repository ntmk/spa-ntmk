function articles(){
    const api = new GhostContentAPI({
        url: 'https://www.ntmk.ca/',
        key: 'some secret key',
        version: 'v2'
    });
    api.posts.browse({limit: 6, include: 'tags,authors'})
        .then((posts) => {
            renderPosts(posts);
        })
        .catch((err) => {
            console.error(err);
        });
}


function renderPosts(posts) {
    var postList = document.querySelector('.blog-content');
    var template = document.createElement('template');
    posts.forEach((post) => {
      template.innerHTML += buildBlogTemplate(post); 
    });
    return postList.appendChild(template.content);
  }

function buildBlogTemplate(post) {
    return `
      <a href="${post.url}" class='blog-item d-flex col-md-4'> 
        <div class="card mt-3 blog-posts">
        <img class='img-fluid' src='${post.feature_image}' ></img>
          <div class='card-body'>
            <div class="blog-details">
              <h5 class="blog-title card-text pt-3">${post.title}</h5>
              <p class="blog-detail card-text">${post.custom_excerpt}</p>
              <p class="blog-meta">${post.primary_author.name} / ${post.published_at.slice(0, 10)}</p>
            </div>
          </div>
        </div>
      </a>
    `;
}


document.addEventListener('DOMContentLoaded', () => {
    articles();
});
