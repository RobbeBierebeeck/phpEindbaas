const tagsDiv = document.querySelector(".input__tags"); // div for tags
const inputTags = document.getElementById("tags"); // input
const inputFakeTags = document.getElementById("tags-fake"); // fake input
const tag = document.querySelector(".tag"); // tag template
let allTags = []; // array of all tags

//preventing the default behaviour of keys to make a tag so they dont display in a tag
inputTags.addEventListener("keydown", (e) => {

    if (e.key === "," || e.key === "Enter" || e.key === " " || e.key === "Tab") {
        e.preventDefault();
    }

});

inputTags.addEventListener("keyup", (e) => {


    let tags = inputTags.value;


    if (e.key === "," && tags !== ""  || e.key === "Enter" && tags !== "" || e.key === " " && tags !== "" || e.key === "Tab" && tags !== "") {
        e.preventDefault();
        //creating span element
        let newTag = document.createElement("span");

        //adding class to span element
        newTag.classList = "tag";

        //pushing tags to array
        allTags.push(tags);

        //adding text node to span element
        inputFakeTags.value = allTags.join(",");

        //adding span element to div
        allTags.forEach(tag => {
            cleanedText = tag.replace(" ", "_");
            newTag.innerText = cleanedText;
            tagsDiv.appendChild(newTag);
            inputTags.value = "";

        });
    }
    if (e.key === "Backspace" && inputTags.value === "" && tagsDiv.childElementCount > 0) {
        allTags.pop();
        tagsDiv.removeChild(tagsDiv.lastChild);
        inputFakeTags.value = allTags.join(",");
    }
});

document.addEventListener("click", e =>{
    if(e.target.classList.contains("tag")){
        allTags.splice(allTags.indexOf(e.target.innerText), 1);
        tagsDiv.removeChild(e.target);
        inputFakeTags.value = allTags.join(",");

    }
})
