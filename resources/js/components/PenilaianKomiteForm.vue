<template>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="vertical-align: middle">No</th>
        <th style="vertical-align: middle">
          Aspek Penilaian Komite
        </th>
        <th colspan="4" class="text-center" style="width: 60px">Checklist</th>
      </tr>
    </thead>
    <tbody>
      <template v-for="group in penilaian">
        <tr>
          <th colspan="9">{{ group[0].kategori }}</th>
        </tr>
        <template v-for="(nilai, index) in group">
          <tr>
            <td>{{ index + 1 }}</td>
            <td>{{ nilai.aspek }}</td>
            <td>
              <div class="d-flex justify-content-center">
                <div class="custom-control custom-checkbox ">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    :name="nilai.id"
                    :id="nilai.id"
                    :value="1"
                    :disabled="disabled"
                    v-model="nilai.nilai"
                  />
                  <label :for="nilai.id" class="custom-control-label"></label>
                </div>
              </div>
            </td>
          </tr>
        </template>
      </template>
      <tr>
        <td colspan="2">Dikerjakan</td>
        <td colspan="6" class="text-center">{{ dikerjakan }}</td>
      </tr>
      <tr>
        <td colspan="2">Tidak Dikerjakan</td>
        <td colspan="6" class="text-center">{{ tidakDikerjakan }}</td>
      </tr>
      <tr>
        <td colspan="2">Persentase</td>
        <td colspan="6" class="text-center">{{ persentase }} %</td>
      </tr>
      <tr>
        <td colspan="2">Total Element Penilaian</td>
        <td colspan="6" class="text-center">{{ elemenPenilaian.length }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ["grouped", "disabled"],

  data() {
    return {
      penilaian: this.grouped
    };
  },

  computed: {
    elemenPenilaian() {
      let nilai = [];
      for (let key in this.penilaian) {
        nilai.push(...this.penilaian[key]);
      }
      return nilai;
    },
    dikerjakan() {
      return this.elemenPenilaian.filter(nilai => nilai.nilai).length;
    },
    tidakDikerjakan() {
      return this.elemenPenilaian.filter(nilai => !nilai.nilai).length;
    },
    persentase() {
      return ((this.dikerjakan / this.elemenPenilaian.length) * 100).toFixed(2);
    }
  }
};
</script>

<style scoped>
.custom-control-label::after,
.custom-control-label::before {
  width: 1.3rem;
  height: 1.3rem;
}
</style>
