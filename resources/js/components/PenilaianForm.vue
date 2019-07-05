<template>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle">No</th>
                <th rowspan="2" style="vertical-align: middle">Aspek Penilaian</th>
                <th colspan="5" style="text-align: center">Nilai</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
            </tr>
        </thead>
        <tbody>
            <template v-for="group in penilaian">
                <tr>
                    <th colspan="9"> {{ group[0].kategori }}</th>
                </tr>
                <template v-for="(nilai, index) in group">
                    <tr>
                        <td>{{ index + 1 }}</td>
                        <td>{{ nilai.aspek }}</td>
                        <td v-for="i in 5" style="width: 50px;">
                            <div class="custom-control custom-radio">
                                <input type="radio" 
                                    class="custom-control-input" 
                                    :name="nilai.id" 
                                    :id="nilai.id.toString() + i.toString()" 
                                    :value="i" 
                                    :checked="nilai.nilai == i"
                                    :disabled="disabled"
                                    v-model="nilai.nilai"
                                >
                                <label :for="nilai.id.toString() + i.toString()" class="custom-control-label"></label>
                            </div>
                        </td>
                    </tr>
                </template>
            </template>
            <tr>
                <td colspan="2">Total Nilai</td>
                <td colspan="6">{{ totalNilai }}</td>
            </tr>
            <tr>
                <td colspan="2">Rata-rata Nilai</td>
                <td colspan="6">{{ rataRataNilai }}</td>
            </tr>
            <tr>
                <td colspan="2">Element Penilaian</td>
                <td colspan="6">{{ elemenPenilaian.length }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props : ['grouped', 'disabled'],

    data() {
        return {
            penilaian : this.grouped
        }
    }, 

    computed : {
        elemenPenilaian() {
            let nilai = []
            for (let key in this.penilaian) {
                nilai.push(...this.penilaian[key])
            }
            return nilai;
        },
        totalNilai() {
            return this.elemenPenilaian.reduce((acc, curr) => acc + curr.nilai, 0)
        },
        rataRataNilai() {
            return (this.totalNilai / this.elemenPenilaian.length).toFixed(2)
        }
    }
}
</script>