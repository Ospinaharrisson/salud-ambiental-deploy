document.addEventListener("DOMContentLoaded", () => {
    let currentStep = parseInt(document.getElementById("progress-bar").dataset.currentStep, 10) || 1;
    const totalSteps = 5;

    function goToStep(step) {
        document.querySelectorAll('.step').forEach(el => el.classList.add('d-none'));
        document.getElementById(`step-${step}`).classList.remove('d-none');

        const percent = (step / totalSteps) * 100;
        const progressBar = document.getElementById('progress-bar');
        progressBar.style.width = percent + "%";
        progressBar.setAttribute("aria-valuenow", percent);
        progressBar.innerText = `Paso ${step} de ${totalSteps}`;
    }

    document.querySelectorAll('.next-step').forEach(btn => {
        btn.addEventListener("click", () => {
            if (currentStep < totalSteps) {
                currentStep++;
                goToStep(currentStep);
            }
        });
    });

    document.querySelectorAll('.prev-step').forEach(btn => {
        btn.addEventListener("click", () => {
            if (currentStep > 1) {
                currentStep--;
                goToStep(currentStep);
            }
        });
    });

    goToStep(currentStep);
});
