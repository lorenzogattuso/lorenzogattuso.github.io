document.addEventListener("DOMContentLoaded", function() {
    const articlesContainer = document.getElementById("articles-container");

    // Fetch the list of articles from the PHP script
    fetch('get_articles.php')
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data)) {
                data.forEach(file => {
                    fetch(`Articles/${file}`)
                        .then(response => response.text())
                        .then(html => {
                            const articleElement = document.createElement('div');
                            articleElement.className = 'article';
                            articleElement.innerHTML = getArticlePreview(html, file);
                            articlesContainer.appendChild(articleElement);
                        })
                        .catch(error => console.error('Error loading article:', error));
                });
            } else {
                console.error('Expected an array but got:', data);
            }
        })
        .catch(error => console.error('Error fetching articles:', error));
});

function getArticlePreview(html, file) {
    const previewLength = 200; // Numero di caratteri per l'anteprima
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = html;

    // Rimuove i tag <style> e <link>
    tempDiv.querySelectorAll('style, link').forEach(node => node.remove());

    // Rimuove qualsiasi impostazione di background o wallpaper
    tempDiv.querySelectorAll('[style*="background"]').forEach(node => node.style.background = 'none');

    // Estrazione del titolo
    const title = tempDiv.querySelector('h1, h2, h3') ? tempDiv.querySelector('h1, h2, h3').textContent : "Titolo non disponibile";

    // Estrazione dell'immagine
    const img = tempDiv.querySelector('img');
    const imgSrc = img ? img.src : '';
    const imgAlt = img ? img.alt : 'Immagine non disponibile';

    // Estrazione del testo per l'anteprima
    const paragraphs = tempDiv.querySelectorAll('p');
    let fullText = "";
    paragraphs.forEach(p => {
        fullText += p.textContent + " ";
    });
    const previewText = fullText.substring(0, previewLength) + '...';

    return `
        <div class="article-preview">
            <img src="${imgSrc}" alt="${imgAlt}">
            <h2>${title}</h2>
            <p>${previewText}</p>
            <button class="read-more" data-file="${file}">Leggi di più</button>
        </div>
    `;
}

document.addEventListener("click", function(event) {
    if (event.target.classList.contains("read-more")) {
        const file = event.target.getAttribute("data-file");
        const articleElement = event.target.parentElement;

        fetch(`Articles/${file}`)
            .then(response => response.text())
            .then(html => {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;

                // Rimuove i tag <style> e <link>
                tempDiv.querySelectorAll('style, link').forEach(node => node.remove());

                // Rimuove qualsiasi impostazione di background o wallpaper
                tempDiv.querySelectorAll('[style*="background"]').forEach(node => node.style.background = 'none');

                articleElement.innerHTML = tempDiv.innerHTML;
            })
            .catch(error => console.error('Error loading article:', error));
    }
});
