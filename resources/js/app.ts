import './bootstrap';

import '../scss/app.scss';

const setAbilityModifierFromScore = function (scoreInput: HTMLInputElement) {
    const targetScore = scoreInput.getAttribute('data-ability-score');
    const modifierElement = document.getElementById(`${targetScore}--modifier`);

    if (!modifierElement) return;

    const targetValue = scoreInput.valueAsNumber;
    const modifier = Math.trunc((targetValue - 10) / 2);
    let sign: string = '±';
    switch(Math.sign(modifier)) {
        case -1: sign = '-'; break;
        case 1: sign = '+'; break;
    }

    modifierElement.innerText = `${sign} ${Math.abs(modifier)}`;
}

document
    .querySelectorAll('.character-sheet__ability-score')
    .forEach(function (node: Element) {
        setAbilityModifierFromScore(node as HTMLInputElement);

        node.addEventListener(
            'input',
            ({ target }) => setAbilityModifierFromScore(target as HTMLInputElement)
        )
    })
