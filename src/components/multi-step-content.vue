<script setup>
import { ref, onMounted, computed, watch, reactive } from "vue";


const form_data = reactive({
  house_rate: 100,
  address_select: '',
  address: '',
  address_select_2: '',
  saving_amout: '',
  saving_calculate: '',
  radio_one: '',
  select_form_qu: 0,
  Ingresos_netos_one: '',
  Ingresos_netos_one_two: '',
  Ingresos_netos_two: '',
  Ingresos_netos_two_two: '',
})

const submit_form = async () => {
  

  const response = await fetch('/wp-admin/admin-ajax.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
      action: 'load_more_product',
      ...form_data
    }),
  });

  if (response.ok) {
      const data = await response.json(); // Parse response as JSON
      console.log(data)
    } else {
      console.error('AJAX request failed');
    }
 

}


  const computed_saving = computed(() => {
    return form_data.saving_amout / form_data.house_rate * 100
  })


</script>

<template>
  <FormKit type="step" name="1">
    <FormKit v-model="form_data.address" type="text" validation="required" />
    <p>{{ form_data.address }}</p>
    <div class="conainer">
      <div>
        <FormKit type="select" name="small_country" :options="[
          '+880',
          '+91'
        ]" />
      </div>
      <div>
        <FormKit placeholder="Enter Phone" type="tel" validation="required" />
      </div>
    </div>
  </FormKit>
  <FormKit type="step" name="2">
    <FormKit v-model="form_data.house_rate" type="text" />
    <input type="range" v-model="form_data.house_rate" id="" min="0" max="1000000">
    <p>{{ form_data.house_rate }}€</p>

  </FormKit>
  <FormKit type="step" name="3">
    <FormKit v-model="form_data.address_select" type="select" label="Which country is the smallest?" name="small_country"
      :options="[
        'Bangladesh',
        'India'
      ]" />
    <p>{{ form_data.address_select }}</p>
  </FormKit>
  <FormKit type="step" name="4">
    <FormKit v-model="form_data.address_select_2" type="select" label="Which country is the smallest?"
      name="small_country" :options="[
        'Primea Propiedad',
        'Cambio de propiedad',
        'Segunda propiedad',
        'Inversion',
      ]" />
    {{ form_data.address_select_2 }}
    <FormKit v-model="form_data.radio_one" type="radio" label="LCuåndo tienes previsto comprar?"
      :options="['Ya la tengo reservada', 'Ya la he elegido', 'En menos de 3 meses', 'En mås de 3 meses']" />
    <p>{{ form_data.radio_one }}</p>
  </FormKit>
  <FormKit type="step" name="5">
    <h4>Sobre la hipoteca</h4>
    <p>Cuåntos ahorros vas a aportar?</p>
    <p>{{ computed_saving.toFixed() }}%</p>
    <input v-model="form_data.saving_amout" type="text" />
    <input type="range" v-model="form_data.saving_amout" min="0" :max=form_data.house_rate>

    <p>Vas a aportar un {{ computed_saving.toFixed() }}% del precio de la vivienda.</p>
    <div>
      <FormKit v-model="form_data.select_form_qu" type="radio" label="Nümero de solicitantes" :options="[1, 2]" />
    </div>
    <p>{{ form_data.select_form_qu }}</p>
  </FormKit>
  <FormKit type="step" name="6">


    <div>
      <div>
        <p>Solicitante 1</p>
        <FormKit v-model="form_data.address_select_2" type="select" label="Situaciön laboral" name="small_country"
          :options="[
            'Primea Propiedad',
            'Cambio de propiedad',
            'Segunda propiedad',
            'Inversion',
          ]" />
        {{ form_data.address_select_2 }}
        <FormKit label="Ingresos netos" v-model="form_data.Ingresos_netos_one" type="number" />
        <FormKit label="Cuotas de otros préstamos" v-model="form_data.Ingresos_netos_one_two" type="number" />
      </div>
      <div v-if="form_data.select_form_qu == '2'">
        <div>
          <p>Solicitante 2</p>
          <FormKit v-model="form_data.address_select_2" type="select" label="Situaciön laboral" name="small_country"
            :options="[
              'Primea Propiedad',
              'Cambio de propiedad',
              'Segunda propiedad',
              'Inversion',
            ]" />
          {{ form_data.address_select_2 }}
          <FormKit label="Ingresos netos" v-model="form_data.Ingresos_netos_two" type="number" />
          <FormKit label="Cuotas de otros préstamos" v-model="form_data.Ingresos_netos_two_two" type="number" />
        </div>
      </div>
    </div>
    <FormKit @click="submit_form" type="submit" label="Send" />
  </FormKit>
</template>

<style scoped>
.conainer {
  display: grid;
  grid-template-columns: 1fr 2fr;
  grid-gap: 10px
}

input[type="range"] {
  -webkit-appearance: none;
  appearance: none;
  width: 100%;
  height: 10px;
  background-color: #ddd;
  border-radius: 5px;
  outline: none;
  margin: 10px 0;
}

input[type="range"]::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 20px;
  height: 20px;
  background-color: #fff;
  border: 3px solid #7dbe93;
  border-radius: 50%;
  cursor: pointer;
  margin-top: -6px;
}

input[type="range"]::-moz-range-thumb {
  width: 20px;
  height: 20px;
  background-color: #4c9aff;
  border: none;
  border-radius: 50%;
  cursor: pointer;
}

input[type="range"]::-webkit-slider-runnable-track {
  width: 100%;
  height: 5px;
  background-color: #707070;
  border-radius: 5px;
}

input[type="range"]::-moz-range-track {
  width: 100%;
  height: 5px;
  background-color: #bbb;
  border-radius: 5px;
}

input[type="range"]::-moz-range-progress {
  height: 5px;
  background-color: #4c9aff;
  border-radius: 5px;
}
</style>