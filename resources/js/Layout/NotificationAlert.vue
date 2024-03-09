<template>
  <Toast/>
  <Toast position="top-left" group="tl"/>
</template>

<script>
import Toast from 'primevue/toast';

export default {
    components: {
        Toast,
    },
  props: {
    title: String,
    breadcrumbItems: Object,
  },
  watch: {
    '$page.props.toastr': {
      handler() {
        if (this.$page.props.toastr != null) {
          for (let i = 0; i < this.$page.props.toastr.length; i++) {
            this.$toast.add({
              severity: this.$page.props.toastr[i]['type'],
              detail: this.$page.props.toastr[i]['message'],
              life: 3000,
            })
          }
        }
      },
      deep: true
    },
    '$page.props.errors': {
      handler() {
        if (this.$page.props.errors != null) {
          let i = 0;
          for (let item in this.$page.props.errors) {
            if (i === 0) {
              this.$toast.add({
                severity: 'error',
                detail: this.$t('base.please_check_data'),
                life: 3000
              })
              this.$toast.add({
                severity: 'error',
                detail: this.$page.props.errors[item],
                life: 3000 + i * 1000
              })
            }
            i++;
          }
        }
      },
      deep: true
    },
  },

  mounted() {
    //check if cant access error
    let urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('cantaccess') && urlParams.get('cantaccess') !== false) {
      _this.$toast.add({
        severity: 'error',
        detail: _this.$t('cant_access'),
        life: 3000,
      })
      setTimeout(function () {
        let urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('cantaccess')) {
          _this.$inertia.get((window.location.toString()).replace('cantaccess=' + urlParams.get('cantaccess'), ''));
        }
      }, 3000)
    }
  },
}
</script>
