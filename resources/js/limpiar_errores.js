export const quitar_errores = () => {
    const inputs = document.querySelectorAll('.input')
    setTimeout(() => {
        for (const item of inputs) {
            if (item.classList.contains('error')) {
                item.classList.remove('error')
            }
        }
    }, 3000);
} 