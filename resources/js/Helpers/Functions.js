import {usePage} from "@inertiajs/vue3";

const asset = (file = null) => {
    return usePage().props.asset_url+'/'+file;
}
const exportExcel = (key = 'export_excel') => {
    let url = (window.location.href).split("?");
    window.location.href = (typeof url[1] == 'undefined' ? url[0] + '?' + key + '=true' : (window.location.href) + '&' + key + '=true');
}
const getAlignFrozen = () => {
  return usePage().props.local==='ar'?'right':'left';
}
export {
    asset,exportExcel,getAlignFrozen
}
