<template>
  <div>
    <span class="badge badge-primary" v-if="terverifikasi">Terverifikasi</span>
    <span
      @click.prevent="submitVerifikasi"
      v-else
      class="badge badge-warning"
      :class="{ disabled: !canVerif }"
      >Belum Diverifikasi</span
    >
  </div>
</template>

<script>
export default {
  props: ["action", "verifikasi", "canVerif"],

  data() {
    return {
      terverifikasi: this.verifikasi
    };
  },

  methods: {
    submitVerifikasi() {
      if (confirm("Apakah anda yakin untuk mem-verifikasi nilai?")) {
        axios.post(this.action).then(res => {
          if (res.data.success) {
            this.terverifikasi = true;
          }
        });
      }
    }
  }
};
</script>

<style scoped>
.badge-warning {
  cursor: pointer;
}
.disabled {
  cursor: default;
  pointer-events: none;
}
</style>

