<template>

    <div class="detail" style="margin-top: 100px;">
      <section class="content mb-4" style="margin-right: -20px;">
        <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
    
          </div>
          <div class="col-md-6">
        
            <div class="card card-primary">
            <div class="card-header" style="background: #2a2185;">
            <h3 class="card-title">Modification d'une promotion</h3>
            </div>
            
            
            <form @submit.prevent="soumettre">
            <div class="card-body">
            <div class="form-group">
            <label for="exampleInputEmail1">Numero_relation :</label>
            <input type="text" class="form-control" id="exampleInputEmail1" v-model="form.numero" :class="{'is-invalid': form.errors.numero}" required>
            <span v-if="form.errors.numero" class="invalid-feedback error">{{ form.errors.numero }}</span>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Promotion :</label>
              <select name="exampleInputPassword1" class="form-control" v-model="form.promotion_id" required>
                <option value=""></option>
                <option :key="Promotion.id" v-for="Promotion in props.Promotions" :value="Promotion.id">{{ Promotion.titre }}</option>
              </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Motif du promotion :</label>
                <textarea class="form-control" id="exampleInputEmail1" v-model="form.motif" required>

                </textarea>
                </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Numero_Employé :</label>
                <select name="exampleInputPassword1" class="form-control" v-model="form.employer_id" required>
                  <option value=""></option>
                  <option :key="Employer.id" v-for="Employer in props.Employers" :value="Employer.id">{{ Employer.numero_employer }}</option>
                </select>
                </div>
                    <div class="form-group">
                        <label>Date du promotion :</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="far fa-calendar-alt"></i>
                                </span>
                              </div>
                                <input type="date" class="form-control float-right" id="reservation" v-model="form.date" required>
                            </div>
                              <!-- /.input group -->
                        </div>
            </div>
            
            <div class="card-footer">
              <Link :href="route('promemple')" class="btn btn-danger mr-2">Retour</Link>
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
        Promotions: Array,
        Employers: Array,
        relier: Object
       })
       const form = useForm({
        numero: props.relier.numero,
        promotion_id: props.relier.promotion_id,
        employer_id: props.relier.employer_id,
        motif: props.relier.motif,
        date: props.relier.date,
         
       })
       const soumettre = ()=>{
       form.put(route("promemple.update", {relier: props.relier.id}), {
           onSuccess: (page)=>{
               useSwalSuccess("Promotion modifié avec success !")
               
               resetForm()
   
           },
           onError: (errors)=>{
               useSwalError("Une erreur a été produite :(")
   
           }
       })
     }
     const resetForm = ()=>{
          form.numero = "",
          form.employer_id = "",
          form.promotion_id = "",
          form.motif = "",
          form.date = ""
  
       }
    </script>
    