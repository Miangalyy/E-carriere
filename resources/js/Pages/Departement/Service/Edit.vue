<template>

  <div class="detail" style="margin-top: 100px;">
    <section class="content mb-4">
      <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
  
        </div>
        <div class="col-md-6">
      
          <div class="card card-primary">
          <div class="card-header" style="background: #2a2185;">
          <h3 class="card-title">Modification d'un service</h3>
          </div>
          
          
          <form @submit.prevent="soumettre">
          <div class="card-body">
          <div class="form-group">
          <label for="exampleInputEmail1">Numero_Service :</label>
          <input type="text" class="form-control" id="exampleInputEmail1" v-model="form.numero_service" :class="{'is-invalid': form.errors.numero_service}" required>
          <span v-if="form.errors.numero_service" class="invalid-feedback error">{{ form.errors.numero_service }}</span>
          </div>
          <div class="form-group">
          <label for="exampleInputPassword1">Responsable :</label>
          <input type="text" class="form-control" id="exampleInputPassword1" v-model="form.responsable" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Direction :</label>
            <select name="exampleInputPassword1" class="form-control" v-model="form.direction_id" required>
              <option value=""></option>
              <option :key="Direction.id" v-for="Direction in props.Directions" :value="Direction.id">{{ Direction.numero_direction }}</option>
            </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Titre :</label>
              <input type="text" class="form-control" id="exampleInputPassword1" v-model="form.titre" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Description :</label>
                <textarea name="exampleInputPassword1" class="form-control" v-model="form.description" :class="{'is-invalid': form.errors.description}"></textarea>
                <span v-if="form.errors.description" class="invalid-feedback error">{{ form.errors.description }}</span>
                </div>
          </div>
          
          <div class="card-footer">
            <Link :href="route('service')" class="btn btn-danger mr-2">Retour</Link>
          <button type="submit" class="btn btn-success">Soumettre</button>
          </div>
          </form>
          </div>
        </div>
      <div class="col-md-4">
      
    </div>
  </div>
  </div>
  </section>
  </div>
  </template>
  
  <script setup>
     import { useForm } from '@inertiajs/inertia-vue3';
     import { useSwalSuccess, useSwalError } from '../../../Composables/alert';
     import { ref } from 'vue';
  
     const props = defineProps({
      Directions: Array,
      Services: Object
     })
     const form = useForm({
      numero_service: props.Services.numero_service,
      responsable: props.Services.responsable,
      direction_id: props.Services.direction_id,
      titre: props.Services.titre,
      description: props.Services.description
      
     })
     const soumettre = ()=>{
     form.post(route("service.update", {service: props.Services.id}), {
         onSuccess: (page)=>{
             useSwalSuccess("Service modifié avec success !")
             
             resetForm()
 
         },
         onError: (errors)=>{
             useSwalError("Une erreur a été produite :(")
 
         }
     })
   }
   const resetForm = ()=>{
        form.numero_service = "",
        form.responsable = "",
        form.direction_id = "",
        form.titre = "",
        form.description = ""

     }
  </script>
  