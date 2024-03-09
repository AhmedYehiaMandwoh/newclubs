import {usePage} from "@inertiajs/vue3";

export const ability_if = {
    beforeMount: (el, binding, vnode) => {
        if (binding.value && !checkAbility(binding.value)) {
            el.classList.add('hidden');
            (vnode.children)?.map((item) => item.el.remove());
        }
    },
};
export const ability_else = {
    beforeMount: (el, binding, vnode) => {
        if (!binding.value || checkAbility(binding.value)) {
            el.classList.add('hidden');
            (vnode.children)?.map((item) => item.el.remove());
        }
    },
};

function checkAbility(abilities) {
    if (Array.isArray(abilities)) {
        let result = true;
        for (const abilityKey in abilities) {
            let item = abilities[abilityKey];
            if (Array.isArray(item)) {
                let temp_result = false;
                for (const itemKey in item) {
                    temp_result = temp_result || checkUserAbility(item[itemKey])
                }
                result = result && temp_result;
            } else {
                result = result && checkUserAbility(item);
            }
        }
        return result;
    } else {
        return checkUserAbility(abilities);
    }
}

function checkUserAbility(ability) {
    return usePage().props.auth.user.id === 1 || usePage().props.auth.abilities.includes(ability);
}
