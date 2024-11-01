export interface Weapon {
    name: string
    damage: string
    properties: string
    mastery?: string
    ability: string
}

export interface Skill {
    ability: string
    name: string
    proficiencies: number
}

export interface Character {
    id: number
    slug: string
    level: number
    class: string
    class_extra?: string
    race: string
    race_extra?: string
    armour_class: number
    proficiency_bonus: number
    speed: number
    inspiration: boolean
    passive_perception: number
    weapons: Weapon[]
    armours: string[]
    abilities: Array<string, number>
    skills: Array<string, Skill>
    saving_throws: Array<string, number>
}
