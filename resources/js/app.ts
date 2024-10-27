import './bootstrap';

import '../scss/app.scss';

const setAbilityModifierFromScore = function (scoreInput: HTMLInputElement) {
    const targetScore = scoreInput.getAttribute('data-ability-score');
    const modifierElement = document.getElementById(`${targetScore}--modifier`);
    const targetValue = scoreInput.valueAsNumber;
    modifierElement.innerText = Math.floor((targetValue - 10) / 2).toString();
}

document
    .querySelectorAll('.character-sheet__ability-score')
    .forEach(function (node: HTMLInputElement) {
        setAbilityModifierFromScore(node);

        node.addEventListener('input', function ({ target }) {
            setAbilityModifierFromScore(target as HTMLInputElement);
        })
    })
