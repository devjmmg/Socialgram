import { inputImage, title, description, btnPost } from "./elements";

const validateBtnPost = () => {
    const valid = title.value.trim() !== '' && description.value.trim() !== '' && inputImage.files.length > 0;
    btnPost.disabled = !valid;
    if (valid) {
        btnPost.classList.remove('opacity-50', 'cursor-not-allowed');
    } else {
        btnPost.classList.add('opacity-50', 'cursor-not-allowed');
    }
};

export {
    validateBtnPost
}