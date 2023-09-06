<script setup>
import { ref, onMounted, computed, watch, reactive } from "vue";

const api = "APIKEY";

const form_data = reactive({
  house_rate: 100000,
  address: "",
  address_select_2: "",
  house_location: "",
  purchase_type: "",
  saving_amout: 20000,
  saving_calculate: "",
  radio_one: "Ya la tengo reservada.",
  select_form_qu: 1,
  Ingresos_netos_one: "",
  Ingresos_netos_one_two: "",
  Ingresos_netos_two: "",
  Ingresos_netos_two_two: "",
  name: "",
  email: "",
  phone: "",
  phone_two: "",
  country_code: "+34 Spain",
  country_code_two: "+34 Spain",
  saving_parcentage: "",
});
const submit_msg = ref("");
const country_code = [
  "+34 Spain",
  "+93 Afghanistan ",
  "+355 Albania ",
  "+213 Algeria ",
  "+1684 American Samoa ",
  "+376 Andorra ",
  "+244 Angola ",
  "+1264 Antigua and Barbuda ",
  "+1268 Anguilla ",
  "+54 Argentina ",
  "+374 Armenia ",
  "+297 Aruba ",
  "+61 Australia ",
  "+43 Austria ",
  "+994 Azerbaijan ",
  "+1242 Bahamas ",
  "+973 Bahrain ",
  "+880 Bangladesh ",
  "+1246 Barbados ",
  "+375 Belarus ",
  "+32 Belgium ",
  "+501 Belize ",
  "+229 Benin ",
  "+1441 Bermuda ",
  "+975 Bhutan ",
  "+591 Bolivia ",
  "+387 Bosnia and Herzegovina ",
  "+267 Botswana ",
  "+55 Brazil ",
  "+246 British Virgin Islands ",
  "+673 Brunei ",
  "+359 Bulgaria ",
  "+226 Burkina Faso ",
  "+257 Burundi ",
  "+855 Cambodia ",
  "+237 Cameroon ",
  "+1 Canada ",
  "+238 Cape Verde ",
  "+345 Cayman Islands ",
  "+236 Central African Republic ",
  "+235 Chad ",
  "+56 Chile ",
  "+86 China ",
  "+61 Christmas Island ",
  "+61 Cocos (Keeling) Islands ",
  "+57 Colombia ",
  "+269 Comoros ",
  "+242 Congo, Republic of the ",
  "+243 Congo, Democratic Republic of the ",
  "+682 Cook Islands ",
  "+506 Costa Rica ",
  "+225 Cote dIvoire ",
  "+385 Croatia ",
  "+53 Cuba ",
  "+599 Curacao ",
  "+357 Cyprus ",
  "+420 Czech Republic ",
  "+253 Djibouti ",
  "+45 Denmark ",
  "+251 Eritrea ",
  "+20 Egypt ",
  "+503 El Salvador ",
  "+240 Equatorial Guinea ",
  "+291 Eritrea ",
  "+372 Estonia ",
  "+358 Finland ",
  "+33 France ",
  "+241 Gabon ",
  "+220 Gambia ",
  "+995 Georgia ",
  "+49 Germany ",
  "+233 Ghana ",
  "+350 Gibraltar ",
  "+30 Greece ",
  "+299 Greenland ",
  "+502 Guatemala ",
  "+224 Guinea ",
  "+245 Guinea-Bissau ",
  "+592 Guyana ",
  "+509 Haiti ",
  "+39 Holy See (Vatican City) ",
  "+504 Honduras ",
  "+852 Hong Kong ",
  "+36 Hungary ",
  "+354 Iceland ",
  "+91 India ",
  "+62 Indonesia ",
  "+98 Iran ",
  "+964 Iraq |",
];
const computed_saving = computed(() => {
  return (form_data.saving_amout / form_data.house_rate) * 100;
});

const submit_form = async () => {
  form_data.saving_parcentage = computed_saving.value.toFixed() + "%";
  const response = await fetch("/wp-admin/admin-ajax.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "load_more_product",
      ...form_data,
    }),
  });

  if (response.ok) {
    const data = await response.json(); // Parse response as JSON
    console.log(data);
    submit_msg.value = "Email Sent Succes";
  } else {
    console.error("AJAX request failed");
  }
};

const formattedHouseRate = computed(() => {
  const formatter = new Intl.NumberFormat("es-ES", {
    style: "currency",
    currency: "EUR",
    minimumFractionDigits: 0,
  });
  return formatter.format(form_data.house_rate);
});

const formattedSavingAmount = computed(() => {
  const formatter = new Intl.NumberFormat("es-ES", {
    style: "currency",
    currency: "EUR",
    minimumFractionDigits: 0,
  });
  return formatter.format(form_data.saving_amout);
});

const closeMsg = () => {
  submit_msg.value = ''
}
</script>

<template>
  <!-- 1 Step  -->
  <FormKit type="step" name="2">
    <div id="house_rate_parent">
      <div id="house_rate_format">
        <FormKit label="¿Cuál es el precio de tu nuevo hogar?" v-model="formattedHouseRate" type="text" />
      </div>
      <div id="houser_rate_not_format">
        <FormKit label="¿Cuál es el precio de tu nuevo hogar?" v-model="form_data.house_rate" type="text" />
      </div>
    </div>

    <input type="range" v-model="form_data.house_rate" id="" min="0" step="10000" max="1000000" />
    <!-- Custom Text in Next Button  -->
    <template #stepNext="{ handlers, node }">
      <FormKit type="button" @click="handlers.incrementStep(1)()" label="Siguiente" data-next="true" />
    </template>
  </FormKit>
  <!-- 2 Step  -->
  <FormKit type="step" name="3">
    <h4>Consigue la mejor hipoteca</h4>
    <FormKit validation="required" v-model="form_data.house_location" type="select" label="¿Dónde está la vivienda?"
      name="House_Location" :options="[
        'Select House Location',
        'Madrid',
        'Palma de Mallorca',
        'Las Palmas de Gran Canaria',
        'La Coruña',
        'Santa Cruz de Tenerife',
        'San Sebastián',
        'Castellón de la Plana',
        'Ciudad Real',
        'Barcelona',
        'Valencia',
        'Sevilla',
        'Zaragoza',
        'Málaga',
        'Murcia',
        'Bilbao',
        'Alicante',
        'Córdoba',
        'Valladolid',
        'Vitoria',
        'Granada',
        'Oviedo',
        'Pamplona',
        'Almería',
        'Burgos',
        'Albacete',
        'Santander',
        'Logroño',
        'Badajoz',
        'Salamanca',
        'Huelva',
        'Lérida',
        'Tarragona',
        'León',
        'Cádiz',
        'Jaén',
        'Orense',
        'Gerona',
        'Lugo',
        'Cáceres',
        'Melilla',
        'Guadalajara',
        'Toledo',
        'Ceuta',
        'Pontevedra',
        'Palencia',
        'Zamora',
        'Ávila',
        'Cuenca',
        'Huesca',
        'Segovia',
        'Soria',
        'Teruel',
      ]" />
    <!-- Custom Text in Next Button  -->
    <template #stepNext="{ handlers, node }">
      <FormKit type="button" @click="handlers.incrementStep(1)()" label="Siguiente" data-next="true" />
    </template>
    <!-- Custom Text in Previous Button  -->
    <template #stepPrevious="{ handlers, node }">
      <FormKit type="button" @click="handlers.incrementStep(-1)()" label="Atrás" />
    </template>
  </FormKit>

  <!-- 3 Step  -->
  <FormKit type="step" name="4">
    <h4>Sobre tu nuevo hogar</h4>
    <FormKit validation="required" v-model="form_data.purchase_type" type="select" label="Tipo de compra" name="Purchase_type
 type
" :options="[
  'Select Type',
  'Primea Propiedad',
  'Cambio de propiedad',
  'Segunda propiedad',
  'Inversion',
]" />

    <FormKit v-model="form_data.radio_one" validation="required" type="radio" label="¿cuándo Genes previsto comprar?"
      :options="[
        'Ya la tengo reservada.',
        'Ya la he escogido.',
        'En menos de tres meses.',
        'En más de tres meses.',
      ]" />
    <!-- Custom Text in Next Button  -->
    <template #stepNext="{ handlers, node }">
      <FormKit type="button" @click="handlers.incrementStep(1)()" label="Siguiente" data-next="true" />
    </template>
    <!-- Custom Text in Previous Button  -->
    <template #stepPrevious="{ handlers, node }">
      <FormKit type="button" @click="handlers.incrementStep(-1)()" label="Atrás" />
    </template>
  </FormKit>

  <!-- 4 Step  -->
  <FormKit type="step" name="5">
    <h4>Sobre la hipoteca</h4>
    <p>¿cuántos ahorros aportas?</p>

    <div class="saving_amount">
      <div class="saving_amount_format">
        <p class="saving_parcengate">{{ computed_saving.toFixed() }}%</p>
        <input type="text" :value="formattedSavingAmount" />
      </div>
      <div class="saving_amount_not_format">
        <input v-model="form_data.saving_amout" type="text" />
      </div>
    </div>

    <input type="range" v-model="form_data.saving_amout" min="0" :max="form_data.house_rate" step="5000" />

    <p>
      Vas a aportar un {{ computed_saving.toFixed() }}% del precio de la
      vivienda.
    </p>
    <div>
      <FormKit validation="required" v-model="form_data.select_form_qu" type="radio" label="Número de compradores."
        :options="[1, 2]" />
    </div>
    <!-- Custom Text in Next Button  -->
    <template #stepNext="{ handlers, node }">
      <FormKit type="button" @click="handlers.incrementStep(1)()" label="Siguiente" data-next="true" />
    </template>
    <!-- Custom Text in Previous Button  -->
    <template #stepPrevious="{ handlers, node }">
      <FormKit type="button" @click="handlers.incrementStep(-1)()" label="Atrás" />
    </template>
  </FormKit>

  <!-- 5 Step  -->
  <FormKit type="step" name="6">
    <div>
      <div>
        <h4>Sobre los compradores</h4>
        <p>Comprador 1</p>
        <FormKit v-model="form_data.address" validation="required" type="select" label="Situación Laboral"
          name="address_four" :options="[
            'Select',
            'Contrato fijo',
            'Funcionario',
            'Autönomo',
            'Contrato Temporal',
            'Otra',
          ]" />
        <div class="mes_format_parent">
          <p class="mes_format">€/Mes</p>
          <FormKit validation="required" label="Ingresos netos" v-model="form_data.Ingresos_netos_one" type="text" />
        </div>
        <div class="mes_format_parent">
          <p class="mes_format">€/Mes</p>
          <FormKit validation="required" label="Cuotas de otros préstamos" v-model="form_data.Ingresos_netos_one_two"
            type="text" />
        </div>
      </div>
      <div class="mt-5" v-if="form_data.select_form_qu == '2'">
        <div>
          <p>Comprador 2</p>

          <FormKit validation="required" v-model="form_data.address_select_2" type="select" label="Situación Laboral"
            name="Address_three" :options="[
              'Select',
              'Contrato fijo',
              'Funcionario',
              'Autönomo',
              'Contrato Temporal',
              'Otra',
            ]" />

          <div class="mes_format_parent">
            <p class="mes_format">€/Mes</p>
            <FormKit validation="required" label="Ingresos netos" name="Ingresos" v-model="form_data.Ingresos_netos_two"
              type="number" />
          </div>
          <div class="mes_format_parent">
            <p class="mes_format">€/Mes</p>
            <FormKit validation="required" label="Cuotas de otros préstamos" name="Cuotas"
              v-model="form_data.Ingresos_netos_two_two" type="number" />
          </div>
        </div>
      </div>
    </div>
    <!-- Custom Text in Next Button  -->
    <template #stepNext="{ handlers, node }">
      <FormKit type="button" @click="handlers.incrementStep(1)()" label="Siguiente" data-next="true" />
    </template>
    <!-- Custom Text in Previous Button  -->
    <template #stepPrevious="{ handlers, node }">
      <FormKit type="button" @click="handlers.incrementStep(-1)()" label="Atrás" />
    </template>
  </FormKit>

  <!-- 6 Step  -->
  <FormKit type="step" name="7">
    <FormKit v-model="form_data.name" placeholder="Nombre..." label="Nombre" name="Name" type="text"
      validation="required" />
    <FormKit v-model="form_data.email" placeholder="Example@gmail.com" label="Email" name="Email" type="email"
      validation="required" />

    <div class="conainer">
      <div>
        <FormKit :wrapper-class="{ 'select_css': true }" type="select" v-model="form_data.country_code_two"
          :options="country_code" />
      </div>
      <div>
        <FormKit placeholder="Teléfono" type="tel" name="Phone" v-model="form_data.phone_two" validation="required" />
      </div>
    </div>
    <FormKit type="checkbox" label="Acepto las políGcas de privacidad y cookies." :value="true" validation="accepted"
      validation-visibility="dirty" />

    <template #stepNext>
      <FormKit @click="submit_form" :wrapper-class="{ 'submit_btn': true }" type="submit" label="Enviar" />
    </template>

    <!-- Custom Text in Previous Button  -->
    <template #stepPrevious="{ handlers, node }">
      <FormKit type="button" @click="handlers.incrementStep(-1)()" label="Atrás" />
    </template>
  </FormKit>

  <p @click="closeMsg" v-show="submit_msg != ''" class="success_msg">
    {{ submit_msg }}
  </p>
</template>

<style>
.success_msg {
  font-weight: bold;
  text-align: center;
  padding: 10px;
  border: 1px solid gray;
  margin-top: 10px;
}

#house_rate_format {
  display: block;
}

#houser_rate_not_format {
  display: none;
}

#house_rate_parent:hover #houser_rate_not_format {
  display: block;
}

#house_rate_parent:hover #house_rate_format {
  display: none;
}

.mes_format_parent {
  display: block;
  position: relative;
}

.mes_format {
  position: absolute;
  right: 7%;
  top: 50%;
  font-weight: 600;
  color: gray;
}

.saving_amount_format {
  display: block;
  position: relative;
}

.saving_parcengate {
  position: absolute;
  right: 7%;
  top: 30%;
  font-weight: bold;
  color: gray;
}

.saving_amount_not_format {
  display: none;
}

.saving_amount:hover .saving_amount_not_format {
  display: block;
}

.saving_amount:hover .saving_amount_format {
  display: none;
}

.mt-5 {
  margin-top: 50px;
}

.conainer {
  display: grid;
  grid-template-columns: 1fr 2fr;
  grid-gap: 10px;
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

.formkit-outer[data-type=multi-step]>.formkit-wrapper>.formkit-steps {
  border: none;
  text-align: left;
}

.formkit-outer[data-type=multi-step]>[data-tab-style=progress]>.formkit-steps {
  border: none;
  box-shadow: none;
  padding: 0px;
}

[data-type=button] .formkit-input,
#input_32 {
  background: #7bbf91;
  color: var(--fk-color-button);
}

.formkit-wrapper.submit_btn button {
  background: #7bbf91;
}

.formkit-wrapper.submit_btn button:hover {
  background: #595959;
}

#input_32:hover {
  background: #595959;
}

[data-type=button] .formkit-input:hover {
  background: #595959;
  color: var(--fk-color-button);
}

.formkit-outer[data-type=multi-step]>[data-tab-style=progress]>.formkit-tabs>.formkit-tab {
  outline: none
}

.select_css div select {
  height: 36px !important;
  padding: 0px 15px;
}</style>
