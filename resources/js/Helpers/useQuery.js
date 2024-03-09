import {useUrlSearchParams} from "@vueuse/core";
import pkg from 'lodash';
const { isArray } = pkg;


export function useQuery() {
    const params = useUrlSearchParams('history')

    function get(name) {
        const value = params[name];
        return value ? value : null;
    }

    function getInt(name) {
        const value = parseInt(get(name));
        if(value === 0) {
            return 0;
        }
        return value ? value : null;
    }

    function getArray(name) {
        const value = get(name+'[]');
        return value ? value : null;
    }

    function getArrayInt(name) {
        let value = getArray(name);
        if(isArray(value)) {
            return value ? value.map((n) => parseInt(n)) : null;
        }
        value = isNaN(parseInt(value)) ? null : [parseInt(value)];
        return value;
    }
    return {get, getInt, getArray, getArrayInt, params};
}
