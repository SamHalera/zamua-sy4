let addButtons = document.querySelectorAll(".btn-new");
let remove = document.querySelectorAll('.btn-delete');



const addFieldItem = (e) => {
    const collectionContainer = document.querySelector(e.currentTarget.dataset.collection);
    // let index = parseInt(collectionContainer.dataset.index);

    // collectionContainer.dataset.index = index + 1;
    // const prototype = collectionContainer.dataset.prototype;

    const item = document.createElement('div');
    item.classList.add('item-field');
 
    
    item.innerHTML += collectionContainer
    .dataset
    .prototype
    .replace(
        /__name__/g, collectionContainer.dataset.index
    
    );

    item.querySelector('.btn-delete').addEventListener('click', () => item.remove());
    collectionContainer.appendChild(item);

 
    collectionContainer.dataset.index++;
    
   

    
}


document
    .querySelectorAll('.btn-delete')
    .forEach(btn => btn.addEventListener('click', (e) => e.currentTarget.closest(".item").remove()));

addButtons.forEach(btn => btn.addEventListener("click", addFieldItem));