<script setup>
import { ref, onMounted, computed, watch, reactive } from "vue";
import GoogleAddressAutocomplete from "vue3-google-address-autocomplete";

const api = "AIzaSyA3jPfYVnWS9hd5kiNpdnV6WVOBC-kVMqM";

const form_data = reactive({
  house_rate: 100,
  address: "",
  address_select_2: "",
  house_location: "",
  purchase_type: "",
  saving_amout: 5000,
  saving_calculate: "",
  radio_one: "",
  select_form_qu: 0,
  Ingresos_netos_one: "",
  Ingresos_netos_one_two: "",
  Ingresos_netos_two: "",
  Ingresos_netos_two_two: "",
  name: "",
  email: "",
  phone: "",
  phone_two: "",
  country_code: "",
  country_code_two: "",
  location: "",
  saving_parcentage: "",
});
const submit_msg = ref("");

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
</script>

<template>
  <FormKit type="step" name="1">
    <h4>Vende tu casa en 60 dias</h4>
    <p>Te llamaremos para resolver todas tus dudas</p>
    <div class="formkit-wrapper" style="margin-bottom: 10px">
      <GoogleAddressAutocomplete
        :apiKey="api"
        v-model="form_data.location"
        class="formkit-input"
        placeholder="🏠 Ciudad de la casa en venta"
      />
    </div>
    <div class="conainer">
      <div>
        <FormKit
          type="select"
          name="Code"
          v-model="form_data.country_code"
          :options="[
            'Select Code',
            '+93',
            '+355',
            '+213',
            '+1684',
            '+376',
            '+244',
            '+1264',
            '+1268',
            '+54',
            '+374',
            '+297',
            '+61',
            '+43',
            '+994',
            '+1242',
            '+973',
            '+880',
            '+1246',
            '+375',
            '+32',
            '+501',
            '+229',
            '+1441',
            '+975',
            '+591',
            '+387',
            '+267',
            '+55',
            '+246',
            '+673',
            '+359',
            '+226',
            '+257',
            '+855',
            '+237',
            '+1',
            '+238',
            '+345',
            '+236',
            '+235',
            '+56',
            '+86',
            '+61',
            '+61',
            '+57',
            '+269',
            '+242',
            '+243',
            '+682',
            '+506',
            '+225',
            '+385',
            '+53',
            '+599',
            '+357',
            '+420',
            '+253',
            '+45',
            '+251',
            '+20',
            '+503',
            '+240',
            '+291',
            '+372',
            '+358',
            '+33',
            '+241',
            '+220',
            '+995',
            '+49',
            '+233',
            '+350',
            '+30',
            '+299',
            '+502',
            '+224',
            '+245',
            '+592',
            '+509',
            '+39',
            '+504',
            '+852',
            '+36',
            '+354',
            '+91',
            '+62',
            '+98',
            '+964',
            '+353',
            '+972',
            '+39',
            '+225',
            '+1876',
            '+962',
            '+7',
            '+81',
            '+967',
            '+996',
            '+254',
            '+686',
            '+965',
            '+856',
            '+371',
            '+961',
            '+266',
            '+231',
            '+218',
            '+423',
            '+370',
            '+352',
            '+853',
            '+389',
            '+261',
            '+60',
            '+960',
            '+223',
            '+356',
            '+692',
            '+230',
            '+262',
            '+52',
            '+691',
            '+373',
            '+377',
            '+976',
            '+382',
            '+212',
            '+258',
            '+95',
            '+265',
            '+674',
            '+977',
            '+31',
          ]"
        />
      </div>
      <div>
        <FormKit
          placeholder="Enter Phone"
          name="Phone"
          v-model="form_data.phone"
          type="tel"
          validation="required"
        />
      </div>
    </div>
    <FormKit
      type="checkbox"
      label="Acepto la politica de privacidad"
      :value="true"
      validation="accepted"
      validation-visibility="dirty"
    />
  </FormKit>

  <FormKit type="step" name="2">
    <div id="house_rate_parent">
      <div id="house_rate_format">
        <FormKit
          label="Ouål es el precio de tu vivienda?"
          v-model="formattedHouseRate"
          type="text"
        />
      </div>
      <div id="houser_rate_not_format">
        <FormKit
          label="Ouål es el precio de tu vivienda?"
          v-model="form_data.house_rate"
          type="text"
        />
      </div>
    </div>

    <input
      type="range"
      v-model="form_data.house_rate"
      id=""
      min="0"
      step="10000"
      max="1000000"
    />
  </FormKit>
  <FormKit type="step" name="3">
    <h4>La mejor hipoteca para ti</h4>
    <FormKit
      v-model="form_data.house_location"
      type="select"
      label="Dönde estå ubicada la vivienda?"
      name="House_Location"
      :options="[
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
      ]"
    />
  </FormKit>
  <FormKit type="step" name="4">
    <h4>Sobre la vivienda</h4>
    <FormKit
      v-model="form_data.purchase_type"
      type="select"
      label="Tipo de compra"
      name="Purchase_type
 type
"
      :options="[
        'Select Type',
        'Primea Propiedad',
        'Cambio de propiedad',
        'Segunda propiedad',
        'Inversion',
      ]"
    />

    <FormKit
      v-model="form_data.radio_one"
      type="radio"
      label="LCuåndo tienes previsto comprar?"
      :options="[
        'Ya la tengo reservada',
        'Ya la he elegido',
        'En menos de 3 meses',
        'En mås de 3 meses',
      ]"
    />
  </FormKit>
  <FormKit type="step" name="5">
    <h4>Sobre la hipoteca</h4>
    <p>Cuåntos ahorros vas a aportar?</p>
    <p>{{ computed_saving.toFixed() }}%</p>

    <div class="saving_amount">
      <div class="saving_amount_format">
        <input type="text" :value="formattedSavingAmount" />
      </div>
      <div class="saving_amount_not_format">
        <input v-model="form_data.saving_amout" type="text" />
      </div>
    </div>

    <input
      type="range"
      v-model="form_data.saving_amout"
      min="0"
      :max="form_data.house_rate"
      step="5000"
    />

    <p>
      Vas a aportar un {{ computed_saving.toFixed() }}% del precio de la
      vivienda.
    </p>
    <div>
      <FormKit
        v-model="form_data.select_form_qu"
        type="radio"
        label="Nümero de solicitantes"
        :options="[1, 2]"
      />
    </div>
  </FormKit>
  <FormKit type="step" name="6">
    <div>
      <div>
        <h4>Sobre los solicitantes</h4>
        <p>Solicitante 1</p>
        <FormKit
          v-model="form_data.address"
          type="select"
          label="Situaciön laboral"
          name="address_four"
          :options="[
            'Select',
            'Contrato fijo',
            'Funcionario',
            'Autönomo',
            'Contrato Temporal',
            'Otra',
          ]"
        />

        <FormKit
          label="Ingresos netos"
          v-model="form_data.Ingresos_netos_one"
          type="number"
        />
        <FormKit
          label="Cuotas de otros préstamos"
          v-model="form_data.Ingresos_netos_one_two"
          type="number"
        />
      </div>
      <div class="mt-5" v-if="form_data.select_form_qu == '2'">
        <div>
          <p>Solicitante 2</p>
          <FormKit
            v-model="form_data.address_select_2"
            type="select"
            label="Situaciön laboral"
            name="Address_three"
            :options="[
              'Select',
              'Contrato fijo',
              'Funcionario',
              'Autönomo',
              'Contrato Temporal',
              'Otra',
            ]"
          />

          <FormKit
            label="Ingresos netos"
            name="Ingresos"
            v-model="form_data.Ingresos_netos_two"
            type="number"
          />
          <FormKit
            label="Cuotas de otros préstamos"
            name="Cuotas"
            v-model="form_data.Ingresos_netos_two_two"
            type="number"
          />
        </div>
      </div>
    </div>
  </FormKit>
  <FormKit type="step" name="7">
    <FormKit
      v-model="form_data.name"
      label="Name"
      name="Name"
      type="text"
      validation="required"
    />
    <FormKit
      v-model="form_data.email"
      label="Email"
      name="Email"
      type="email"
      validation="required"
    />

    <div class="conainer">
      <div>
        <FormKit
          type="select"
          v-model="form_data.country_code_two"
          :options="[
            'Select Code',
            '+93',
            '+355',
            '+213',
            '+1684',
            '+376',
            '+244',
            '+1264',
            '+1268',
            '+54',
            '+374',
            '+297',
            '+61',
            '+43',
            '+994',
            '+1242',
            '+973',
            '+880',
            '+1246',
            '+375',
            '+32',
            '+501',
            '+229',
            '+1441',
            '+975',
            '+591',
            '+387',
            '+267',
            '+55',
            '+246',
            '+673',
            '+359',
            '+226',
            '+257',
            '+855',
            '+237',
            '+1',
            '+238',
            '+345',
            '+236',
            '+235',
            '+56',
            '+86',
            '+61',
            '+61',
            '+57',
            '+269',
            '+242',
            '+243',
            '+682',
            '+506',
            '+225',
            '+385',
            '+53',
            '+599',
            '+357',
            '+420',
            '+253',
            '+45',
            '+251',
            '+20',
            '+503',
            '+240',
            '+291',
            '+372',
            '+358',
            '+33',
            '+241',
            '+220',
            '+995',
            '+49',
            '+233',
            '+350',
            '+30',
            '+299',
            '+502',
            '+224',
            '+245',
            '+592',
            '+509',
            '+39',
            '+504',
            '+852',
            '+36',
            '+354',
            '+91',
            '+62',
            '+98',
            '+964',
            '+353',
            '+972',
            '+39',
            '+225',
            '+1876',
            '+962',
            '+7',
            '+81',
            '+967',
            '+996',
            '+254',
            '+686',
            '+965',
            '+856',
            '+371',
            '+961',
            '+266',
            '+231',
            '+218',
            '+423',
            '+370',
            '+352',
            '+853',
            '+389',
            '+261',
            '+60',
            '+960',
            '+223',
            '+356',
            '+692',
            '+230',
            '+262',
            '+52',
            '+691',
            '+373',
            '+377',
            '+976',
            '+382',
            '+212',
            '+258',
            '+95',
            '+265',
            '+674',
            '+977',
            '+31',
          ]"
        />
      </div>
      <div>
        <FormKit
          placeholder="Enter Phone"
          type="tel"
          name="Phone"
          v-model="form_data.phone_two"
          validation="required"
        />
      </div>
    </div>
    <FormKit
      type="checkbox"
      label="Acepto todos IOS tratamientos"
      :value="true"
      validation="accepted"
      validation-visibility="dirty"
    />

    <template #stepNext>
      <FormKit @click="submit_form" type="submit" label="Send" />
    </template>
  </FormKit>

  <p style="color: red">
    <b>
      {{ submit_msg }}
    </b>
  </p>
</template>

<style scoped>
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

.saving_amount_format {
  display: block;
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
</style>
