let page = 1;
window.onscroll = () => {
  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
    page++;
    fetch(`./getUsers.php?page=${page}`)
      .then(response => response.json())
      .then(users => {
        users.forEach(user => {
          const userElement = `
            <div class="user">
              <div class="user-avatar">
                <img src="${user.Avatar}" alt="${user.Name}" />
              </div>
              <div class="user-data">
                <h3 class="user-name">${user.Name}</h3>
                <p class="user-username">${user.Username}</p>
                <p class="user-role">${user.Role}</p>
              </div>
              <div class="user-actions">
                <a href="./edit-user.php?id=${user.UserId}" class="user-action">
                  <span class="material-icons"> edit </span>
                </a>
                <a href="./delete-user.php?id=${user.UserId}" class="user-action">
                  <span class="material-icons"> delete </span>
                </a>
              </div>
            </div>
          `;
          document.body.insertAdjacentHTML('beforeend', userElement);
        });
      });
  }
};