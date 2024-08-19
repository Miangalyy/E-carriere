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
        <h3 class="card-title">Modification d'une Fonction</h3>
        </div>
        
        
        <form @submit.prevent="soumettre">
        <div class="card-body">
        <div class="form-group">
        <label for="exampleInputEmail1">Numero_Fonction :</label>
        <input type="text" class="form-control" id="exampleInputEmail1" v-model="form.numero_fonction" :class="{'is-invalid': form.errors.numero_fonction}" required>
        <span v-if="form.errors.numero_fonction" class="invalid-feedback error">{{ form.errors.numero_fonction }}</span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Service :</label>
          <select name="exampleInputPassword1" class="form-control" v-model="form.service_id" required>
            <option value=""></option>
            <option :key="Service.id" v-for="Service in props.Services" :value="Service.id">{{ Service.numero_service }}</option>
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
          <Link :href="route('fonction')" class="btn btn-danger mr-2">Retour</Link>
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
      Services: Array,
      Fonctions: Object
     })
     const form = useForm({
      numero_fonction: props.Fonctions.numero_fonction,
      service_id: props.Fonctions.service_id,
      titre: props.Fonctions.titre,
      description: props.Fonctions.description
      
     })
     const soumettre = ()=>{
     form.put(route("fonction.update", {fonction: props.Fonctions.id}), {
         onSuccess: (page)=>{
             useSwalSuccess("Fonction modifié avec success !")
             
             resetForm()
 
         },
         onError: (errors)=>{
             useSwalError("Une erreur a été produite :(")
 
         }
     })
   }
   const resetForm = ()=>{
        form.numero_fonction = "",
        form.service_id = "",
        form.titre = "",
        form.description = ""

     }
  </script>
  