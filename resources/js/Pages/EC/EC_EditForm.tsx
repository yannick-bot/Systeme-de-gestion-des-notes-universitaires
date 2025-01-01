import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import MyInput from '@/Components/MyInput';
import MyLabel from '@/Components/MyLabel';
import { useForm, } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import { useEffect } from 'react';


interface UE {
    id: number;
    code: string,
    nom: string,
    credits_ects: number,
    semestre: number
}

interface EC {
    id: number,
    code: string,
    nom: string,
    coefficient: number,
    ue_id: number
}


interface Props {
    ues: UE[];
    ec: EC;
}


export default function EditECForm({ec, ues}: Props ) {
console.log( route('EC.update', ec.id));


    const { data, setData, patch, processing, reset, errors } = useForm({
        code: ec.code,
        nom: ec.nom,
        coefficient: ec.coefficient,
        ue_id: ec.ue_id
    });



    function handleSubmit(e : React.FormEvent<HTMLFormElement>) {
        e.preventDefault();
        patch(route('EC.update', ec.id), { onSuccess: () => reset() });
    }

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    EC
                </h2>
            }
        >
            <Head title="EC_Form" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg p-5">
                        <form  onSubmit={handleSubmit}>
                            <MyInput
                                type='text'
                                name='code'
                                id='codeID'
                                labelValue='CODE: '
                                inputValue={data.code}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('code', e.target.value)}
                            />
                            {errors.code &&  <InputError message={errors.code} className="mt-2" />}
                            <MyInput
                                type='text'
                                name='nom'
                                id='nomID'
                                labelValue='NOM: '
                                inputValue={data.nom}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('nom', e.target.value)}
                            />
                            {errors.nom && <InputError message={errors.nom} className="mt-2" />}
                            <MyInput
                                type='number'
                                name='coefficient'
                                id='coefficientID'
                                labelValue="COEFFICIENT: "
                                inputValue={data.coefficient}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('coefficient', Number(e.target.value))}
                            />
                            {errors.coefficient && <InputError message={errors.coefficient} className="mt-2" />}
                            <MyLabel labelFor="ueID">UE: </MyLabel>
                            <select name="ue"
                                id="ueID"
                                value={data.ue_id}
                                onChange={e => setData('ue_id', Number(e.target.value))}
                            >
                                {ues.map(ue => {
                                   return <option key={ue.id} value={ue.id}> {ue.nom} </option>
                                })}
                            </select>
                            {errors.ue_id && <InputError message={errors.ue_id} className="mt-2" />}
                            <div className='my-4'>
                                <button disabled={processing} className='rounded-xl p-2 border-2'>Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
