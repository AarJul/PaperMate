// Assuming data is an array of objects containing the title, image path, and description
const data = [
    { title: '投稿タイトル 1', imagePath: 'path/to/image1.jpg', description: '写真 1 の説明' },
    { title: '投稿タイトル 2', imagePath: 'path/to/image2.jpg', description: '写真 2 の説明' },
    // Add more data here
  ];
  
  const template = document.getElementById('document');
  const row = document.querySelector('.row.grid-container');
  
  data.forEach(item => {
    const clone = template.content.cloneNode(true);
    const title = clone.querySelector('h3');
    const image = clone.querySelector('img');
    const description = clone.querySelector('p');
  
    title.textContent = item.title;
    image.src = item.imagePath;
    image.alt = item.title;
    description.textContent = item.description;
  
    // Apply the grid-item class to each cloned item
    clone.classList.add('template');
  
    row.appendChild(clone);
  });
  