import './bootstrap';

import * as bootstrap from 'bootstrap';

import '../scss/app.scss';

/**
 * Tooltips
 */

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
[...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

const plusOrMinus = function (n: number): string {
    let sign = '±';
    switch(Math.sign(n)) {
        case -1: sign = '-'; break;
        case 1: sign = '+'; break;
    }

    return `${sign}${Math.abs(n)}`;

}

const setAbilityModifierFromScore = function (scoreInput: HTMLInputElement) {
    const targetScore = scoreInput.getAttribute('data-ability-score');
    const modifierElement = document.getElementById(`${targetScore}--modifier`);

    if (!modifierElement) return;

    const targetValue = scoreInput.valueAsNumber;
    const modifier = Math.trunc((targetValue - 10) / 2);
    modifierElement.innerText = plusOrMinus(modifier)
    modifierElement.setAttribute('data-value', modifier.toString());

    setAllSkillModifiers();
}

const setSkillModifier = function (node: Element) {
    if (!(node instanceof HTMLElement)) {
        throw new Error('Not an HTML Element');
    }

    const skillName = node.getAttribute('data-skill');
    const abilityName = node.getAttribute('data-ability');

    if (!(skillName && abilityName)) {
        throw new Error(`Either no skill name (${skillName}) or no ability name (${abilityName}).`);
    }

    const abilitySpanSelector = `#${abilityName}--modifier`
    const abilitySpan = document.querySelector(abilitySpanSelector);

    const abilityModifier = parseInt(abilitySpan?.getAttribute('data-value') ?? '0');


    const proficiencyBonusInput = document.querySelector('input[type=number][name=proficiency_bonus]');
    if (!(proficiencyBonusInput instanceof HTMLInputElement)) {
        throw new Error(`Proficiency bonus for ${skillName} not an input`)
    }

    const proficiencyBonus = proficiencyBonusInput.valueAsNumber;

    const numberOfProficienciesInput = document.querySelector(`input[type=number][name=skills\\[${skillName}\\]\\[proficiencies\\]]`);
    if (!(numberOfProficienciesInput instanceof HTMLInputElement)) {
        throw new Error(`Proficiency count for ${skillName} not an input`)
    }

    const numberOfProficiencies = numberOfProficienciesInput.valueAsNumber;

    const proficiencyBonusCalculated = proficiencyBonus * numberOfProficiencies;

    const totalModifier = proficiencyBonusCalculated + abilityModifier;

    node.innerText = plusOrMinus(totalModifier);
}

const setInitiative = () => {
    const dexMod = Number(document.querySelector('#dexterity--modifier')?.getAttribute('data-value'));

    console.log(dexMod);

    const initiativeDisplay = document.querySelector('#initiative');
    if (initiativeDisplay instanceof HTMLElement) {
        initiativeDisplay.innerText = plusOrMinus(dexMod);
    }
}

const setAllSkillModifiers = () => {
    setInitiative();
    document
        .querySelectorAll('[data-fill-with=skill-score]')
        .forEach(setSkillModifier)
}

document
    .querySelectorAll('.character-sheet__skill > input[type=number], input[type=number][name=proficiency_bonus]')
    .forEach((node: Element) => (node as HTMLInputElement).addEventListener('input', setAllSkillModifiers))

document
    .querySelectorAll('.character-sheet__ability-score')
    .forEach(function (node: Element) {
        setAbilityModifierFromScore(node as HTMLInputElement);

        node.addEventListener(
            'input',
            ({ target }) => setAbilityModifierFromScore(target as HTMLInputElement)
        )
    })

document.querySelector('button#character-sheet-save')?.addEventListener('click', (e) => {
    const form = document.querySelector('form#character-sheet');
    if (!(form instanceof HTMLFormElement)) {
        throw new Error('Form does not exist somehoe')
    }

    const formData = new FormData(form);
    console.table(Object.fromEntries(formData));
})

setAllSkillModifiers();
